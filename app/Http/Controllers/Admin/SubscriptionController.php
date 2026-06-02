<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use App\Models\Profile;
use App\Imports\SubscriptionsImport;
use App\Exports\SubscriptionsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SubscriptionController extends Controller
{
    public function index()
    {
        $data = Subscription::with(['user', 'profile'])
            ->latest()
            ->paginate(20);
        
        // Statistics
        $stats = [
            'total' => Subscription::all()->count(),
            'active' => Subscription::query()->where('status', 'active')->count(),
            'expired' => Subscription::query()->where('status', 'expired')->count(),
            'premium' => Subscription::query()->where('plan_type', 'premium')->count(),
            'monthly_revenue' => Subscription::query()->where('status', 'active')
                ->where('billing_cycle', 'monthly')
                ->sum('amount'),
            'yearly_revenue' => Subscription::query()->where('status', 'active')
                ->where('billing_cycle', 'yearly')
                ->sum('amount'),
        ];
        
        return view('admin.subscriptions.index', compact('data', 'stats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'profile_id' => 'required|exists:profiles,id',
            'plan_type' => 'required|in:free,basic,premium,vip',
            'billing_cycle' => 'required|in:monthly,quarterly,yearly,lifetime',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string',
            'transaction_id' => 'nullable|string|unique:subscriptions,transaction_id',
            'ends_at' => 'nullable|date',
            'is_auto_renew' => 'boolean',
        ]);

        $subscription = Subscription::create([
            'user_id' => $request->user_id,
            'profile_id' => $request->profile_id,
            'plan_type' => $request->plan_type,
            'plan_name' => ucfirst($request->plan_type) . ' Plan',
            'billing_cycle' => $request->billing_cycle,
            'amount' => $request->amount,
            'currency' => $request->currency ?? 'INR',
            'starts_at' => now(),
            'ends_at' => $request->ends_at ?? $this->calculateEndDate($request->billing_cycle),
            'status' => Subscription::STATUS_ACTIVE,
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'payment_status' => 'success',
            'is_auto_renew' => $request->is_auto_renew ?? true,
        ]);

        // Update profile premium status
        $profile = Profile::findOrFail($request->profile_id);
        $profile->update([
            'is_premium' => true,
            'premium_expiry' => $subscription->ends_at,
        ]);

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscription created successfully');
    }

    public function update(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        
        $request->validate([
            'plan_type' => 'sometimes|in:free,basic,premium,vip',
            'billing_cycle' => 'sometimes|in:monthly,quarterly,yearly,lifetime',
            'amount' => 'sometimes|numeric|min:0',
            'status' => 'sometimes|in:active,expired,cancelled,pending,failed',
            'ends_at' => 'nullable|date',
            'is_auto_renew' => 'boolean',
            'cancellation_reason' => 'nullable|string',
        ]);

        $subscription->update($request->only([
            'plan_type', 'plan_name', 'billing_cycle', 'amount', 
            'status', 'ends_at', 'is_auto_renew', 'cancellation_reason'
        ]));

        // Update profile if status changed
        if ($request->has('status') && $subscription->profile) {
            $subscription->profile->update([
                'is_premium' => $subscription->status === 'active',
                'premium_expiry' => $subscription->status === 'active' ? $subscription->ends_at : null,
            ]);
        }

        return back()->with('success', 'Subscription updated successfully');
    }

    public function destroy($id)
    {
        $subscription = Subscription::findOrFail($id);
        
        // Update profile premium status if needed
        if ($subscription->profile && $subscription->status === 'active') {
            $subscription->profile->update([
                'is_premium' => false,
                'premium_expiry' => null,
            ]);
        }
        
        $subscription->delete();
        return back()->with('success', 'Subscription deleted');
    }

    public function show($id)
    {
        $subscription = Subscription::with(['user', 'profile'])->findOrFail($id);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function importForm()
    {
        return view('admin.subscriptions.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new SubscriptionsImport, $request->file('file'));
        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'Subscriptions imported successfully.');
    }

    public function export()
    {
        return Excel::download(new SubscriptionsExport, 'subscriptions_' . date('Y-m-d') . '.xlsx');
    }

    // Additional methods for subscription management
    public function cancel(Request $request, $id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->cancel($request->reason);
        
        return back()->with('success', 'Subscription cancelled successfully');
    }

    public function renew($id)
    {
        $subscription = Subscription::findOrFail($id);
        $newSubscription = $subscription->renew();
        
        if ($newSubscription) {
            return redirect()->route('admin.subscriptions.show', $newSubscription->id)
                ->with('success', 'Subscription renewed successfully');
        }
        
        return back()->with('error', 'Auto-renew is disabled for this subscription');
    }

    public function upgrade(Request $request, $id)
    {
        $request->validate([
            'new_plan_type' => 'required|in:basic,premium,vip',
            'payment_method' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        $subscription = Subscription::findOrFail($id);
        
        $paymentData = [
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'gateway' => $request->gateway ?? 'manual',
            'auto_renew' => $request->auto_renew ?? true,
        ];
        
        $newSubscription = $subscription->upgradeTo($request->new_plan_type, $paymentData);
        
        return redirect()->route('admin.subscriptions.show', $newSubscription->id)
            ->with('success', 'Subscription upgraded successfully');
    }

    public function expiringSoon()
    {
        $expiringSubscriptions = Subscription::expiringSoon(7)
            ->with(['user', 'profile'])
            ->get();
            
        return view('admin.subscriptions.expiring', compact('expiringSubscriptions'));
    }

    public function reports(Request $request)
    {
        $startDate = \Carbon\Carbon::parse($request->input('start_date', now()->startOfMonth()))->startOfDay();
        $endDate = \Carbon\Carbon::parse($request->input('end_date', now()->endOfMonth()))->endOfDay();
        
        $reports = [
            'total_subscriptions' => Subscription::query()->whereBetween('created_at', [$startDate, $endDate])->count(),
            'total_revenue' => Subscription::query()->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'active')
                ->sum('amount'),
            'by_plan' => [
                'free' => Subscription::query()->where('plan_type', 'free')->count(),
                'basic' => Subscription::query()->where('plan_type', 'basic')->count(),
                'premium' => Subscription::query()->where('plan_type', 'premium')->count(),
                'vip' => Subscription::query()->where('plan_type', 'vip')->count(),
            ],
            'by_cycle' => [
                'monthly' => Subscription::query()->where('billing_cycle', 'monthly')->count(),
                'yearly' => Subscription::query()->where('billing_cycle', 'yearly')->count(),
                'lifetime' => Subscription::query()->where('billing_cycle', 'lifetime')->count(),
            ]
        ];
        
        return view('admin.subscriptions.reports', compact('reports', 'startDate', 'endDate'));
    }

    private function calculateEndDate($billingCycle)
    {
        switch ($billingCycle) {
            case 'monthly':
                return now()->addMonth();
            case 'quarterly':
                return now()->addMonths(3);
            case 'yearly':
                return now()->addYear();
            case 'lifetime':
                return now()->addYears(100);
            default:
                return now()->addMonth();
        }
    }
}