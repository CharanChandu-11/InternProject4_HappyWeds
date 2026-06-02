@extends('layouts.admin')
@section('title', 'Subscriptions - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    .page-spacing {
        padding-left: clamp(2rem, 4vw, 4rem) !important;
        padding-right: clamp(2rem, 4vw, 4rem) !important;
    }

    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .bg-gradient-signature {
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
    }

    body { 
        background-color: #f8fafc; 
        position: relative; 
        z-index: 1;
        overflow-x: hidden;
    }

    .bg-glow-orb {
        position: fixed;
        border-radius: 50%;
        filter: blur(120px);
        z-index: -2;
        animation: pulseGlow 10s infinite alternate ease-in-out;
        pointer-events: none;
    }
    
    .orb-1 { top: -15%; left: -10%; width: 50vw; height: 50vw; background: rgba(231, 84, 128, 0.12); }
    .orb-2 { bottom: -20%; right: -10%; width: 60vw; height: 60vw; background: rgba(10, 10, 10, 0.08); animation-delay: -5s; }

    @keyframes pulseGlow {
        0% { transform: scale(1) translate(0, 0); opacity: 0.5; }
        100% { transform: scale(1.1) translate(20px, -20px); opacity: 0.8; }
    }

    .bg-floating-element {
        position: fixed;
        z-index: -1;
        opacity: 0.05;
        pointer-events: none;
        animation: floatAnim var(--duration, 8s) ease-in-out infinite;
    }

    @keyframes floatAnim {
        0% { transform: translateY(0) rotate(var(--rot-start, 0deg)); }
        50% { transform: translateY(-30px) rotate(var(--rot-mid, 15deg)); }
        100% { transform: translateY(0) rotate(var(--rot-start, 0deg)); }
    }

    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    .stats-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255,255,255,0.4);
    }

    .stats-card:hover {
        transform: translateY(-5px);
        background: #ffffff;
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.08);
    }

    .premium-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: block;
    }

    .premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.8rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: #334155;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .premium-input:focus {
        border-color: #e75480;
        background-color: #ffffff;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
        outline: none;
    }

    .premium-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important; 
        background: transparent;
    }

    .premium-table th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: #94a3b8;
        border: none;
        padding: 0 1.5rem 0.5rem 1.5rem;
        background: transparent;
    }

    .premium-table tbody tr {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        border-radius: 20px;
    }

    .premium-table tbody tr td:first-child { border-top-left-radius: 20px; border-bottom-left-radius: 20px; border-left: 4px solid transparent; }
    .premium-table tbody tr td:last-child { border-top-right-radius: 20px; border-bottom-right-radius: 20px; }

    .premium-table td {
        vertical-align: middle;
        border: none;
        padding: 1.2rem 1.5rem;
        color: #1e293b;
        font-weight: 600;
    }

    .premium-table tbody tr:hover {
        transform: scale(1.01) translateY(-3px);
        background: #ffffff;
        box-shadow: 0 15px 30px rgba(231, 84, 128, 0.08);
    }

    .premium-table tbody tr:hover td:first-child {
        border-left: 4px solid #e75480;
    }

    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 12px;
        padding: 0.8rem 1.5rem;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }

    .action-icon-btn {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        border: none;
        background: #f1f5f9;
        color: #64748b;
        font-size: 1.1rem;
        margin: 0 4px;
    }

    .action-icon-btn.edit:hover { background: #3b82f6; color: white; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(59,130,246,0.25); }
    .action-icon-btn.delete:hover { background: #ef4444; color: white; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(239,68,68,0.25); }
    .action-icon-btn.view:hover { background: #8b5cf6; color: white; transform: translateY(-2px); box-shadow: 0 6px 12px rgba(139,92,246,0.25); }
    
    .modal-premium .modal-content {
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(15px);
        border-radius: 28px;
        border: 1px solid rgba(255,255,255,0.6);
    }

    .pagination {
        gap: 8px;
        flex-wrap: wrap;
    }

    .page-item {
        margin: 0;
    }

    .page-link {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        border-radius: 12px !important;
        border: none;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(4px);
        color: #475569;
        padding: 0.6rem 1rem;
        transition: all 0.2s ease;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }

    .page-link:hover {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(231, 84, 128, 0.2);
    }

    .page-item.active .page-link {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: white;
        border: none;
        box-shadow: 0 4px 10px rgba(231, 84, 128, 0.3);
    }

    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-active {
        background: #10b98120;
        color: #10b981;
        border: 1px solid #10b98140;
    }

    .status-expired {
        background: #ef444420;
        color: #ef4444;
        border: 1px solid #ef444440;
    }

    .status-cancelled {
        background: #f59e0b20;
        color: #f59e0b;
        border: 1px solid #f59e0b40;
    }

    .status-pending {
        background: #3b82f620;
        color: #3b82f6;
        border: 1px solid #3b82f640;
    }

    .plan-badge {
        padding: 0.3rem 0.8rem;
        border-radius: 8px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .plan-free { background: #94a3b8; color: white; }
    .plan-basic { background: #3b82f6; color: white; }
    .plan-premium { background: #8b5cf6; color: white; }
    .plan-vip { background: linear-gradient(90deg, #e75480, #f59e0b); color: white; }

    @media (max-width: 768px) {
        .stats-card { margin-bottom: 1rem; }
    }
</style>
@endpush

@section('content')
<div class="bg-glow-orb orb-1"></div>
<div class="bg-glow-orb orb-2"></div>

<svg width="0" height="0" class="position-absolute">
    <defs>
        <linearGradient id="signatureGradient" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#0a0a0a" />
            <stop offset="100%" stop-color="#e75480" />
        </linearGradient>
    </defs>
</svg>

<div class="container-fluid py-5 page-spacing font-sans" style="max-width: 1400px;">
    <div class="animate-card">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
            <div>
                <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Subscriptions</h2>
                <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage user subscriptions, plans, and payments.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.subscriptions.export') }}" class="btn-glow" style="padding: 0.6rem 1.2rem;">
                    <i class="bi bi-download me-2"></i>Export
                </a>
                <a href="{{ route('admin.subscriptions.import.form') }}" class="btn-glow" style="background: #334155; box-shadow: none; padding: 0.6rem 1.2rem;">
                    <i class="bi bi-upload me-2"></i>Import
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card delay-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Statistics Cards -->
    @if(isset($stats))
    <div class="row mb-4 animate-card delay-1">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="premium-label mb-1">Total Subscriptions</p>
                        <h3 class="fw-bold mb-0">{{ $stats['total'] }}</h3>
                    </div>
                    <i class="bi bi-people-fill fs-1 text-muted opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="premium-label mb-1">Active Subscriptions</p>
                        <h3 class="fw-bold mb-0 text-success">{{ $stats['active'] }}</h3>
                    </div>
                    <i class="bi bi-check-circle-fill fs-1 text-success opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="premium-label mb-1">Premium Users</p>
                        <h3 class="fw-bold mb-0 text-gradient">{{ $stats['premium'] }}</h3>
                    </div>
                    <i class="bi bi-star-fill fs-1 text-warning opacity-50"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <p class="premium-label mb-1">Monthly Revenue</p>
                        <h3 class="fw-bold mb-0">₹{{ number_format($stats['monthly_revenue'] ?? 0, 2) }}</h3>
                    </div>
                    <i class="bi bi-currency-rupee fs-1 text-muted opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Subscriptions Table -->
    <div class="animate-card delay-2">
        <div class="table-responsive">
            <table class="table premium-table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Plan</th>
                        <th>Amount</th>
                        <th>Billing Cycle</th>
                        <th>Starts At</th>
                        <th>Ends At</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $subscription)
                    <tr>
                        <td class="text-muted fw-bold">#{{ $subscription->id }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $subscription->user->name ?? 'N/A' }}</div>
                            <small class="text-muted">{{ $subscription->user->email ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <span class="plan-badge plan-{{ $subscription->plan_type }}">
                                {{ ucfirst($subscription->plan_type) }}
                            </span>
                        </td>
                        <td class="fw-bold">₹{{ number_format($subscription->amount, 2) }}</td>
                        <td>{{ ucfirst($subscription->billing_cycle) }}</td>
                        <td>{{ $subscription->starts_at ? $subscription->starts_at->format('d M Y') : '—' }}</td>
                        <td>
                            {{ $subscription->ends_at ? $subscription->ends_at->format('d M Y') : '—' }}
                            @if($subscription->days_remaining > 0 && $subscription->days_remaining <= 7)
                                <span class="badge bg-warning text-dark ms-1">{{ $subscription->days_remaining }} days left</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusClass = match($subscription->status) {
                                    'active' => 'status-active',
                                    'expired' => 'status-expired',
                                    'cancelled' => 'status-cancelled',
                                    default => 'status-pending'
                                };
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <i class="bi bi-{{ $subscription->status == 'active' ? 'check-circle-fill' : ($subscription->status == 'expired' ? 'x-circle-fill' : 'clock-fill') }} me-1"></i>
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.subscriptions.show', $subscription->id) }}" class="action-icon-btn view">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                            <button type="button" class="action-icon-btn edit" data-bs-toggle="modal" data-bs-target="#editSubscriptionModal{{ $subscription->id }}">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this subscription?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-icon-btn delete"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Edit Modal -->
                    <div class="modal fade modal-premium" id="editSubscriptionModal{{ $subscription->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header border-0 pt-4 px-4">
                                    <h5 class="modal-title fw-bold">Edit Subscription #{{ $subscription->id }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body px-4">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">PLAN TYPE</label>
                                                <select name="plan_type" class="form-control premium-input">
                                                    <option value="free" {{ $subscription->plan_type == 'free' ? 'selected' : '' }}>Free</option>
                                                    <option value="basic" {{ $subscription->plan_type == 'basic' ? 'selected' : '' }}>Basic</option>
                                                    <option value="premium" {{ $subscription->plan_type == 'premium' ? 'selected' : '' }}>Premium</option>
                                                    <option value="vip" {{ $subscription->plan_type == 'vip' ? 'selected' : '' }}>VIP</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">BILLING CYCLE</label>
                                                <select name="billing_cycle" class="form-control premium-input">
                                                    <option value="monthly" {{ $subscription->billing_cycle == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                                    <option value="quarterly" {{ $subscription->billing_cycle == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                                                    <option value="yearly" {{ $subscription->billing_cycle == 'yearly' ? 'selected' : '' }}>Yearly</option>
                                                    <option value="lifetime" {{ $subscription->billing_cycle == 'lifetime' ? 'selected' : '' }}>Lifetime</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">AMOUNT</label>
                                                <input type="number" step="0.01" name="amount" class="form-control premium-input" value="{{ $subscription->amount }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">STATUS</label>
                                                <select name="status" class="form-control premium-input">
                                                    <option value="active" {{ $subscription->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="expired" {{ $subscription->status == 'expired' ? 'selected' : '' }}>Expired</option>
                                                    <option value="cancelled" {{ $subscription->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">ENDS AT</label>
                                                <input type="datetime-local" name="ends_at" class="form-control premium-input" value="{{ $subscription->ends_at ? $subscription->ends_at->format('Y-m-d\TH:i') : '' }}">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="premium-label">AUTO RENEW</label>
                                                <select name="is_auto_renew" class="form-control premium-input">
                                                    <option value="1" {{ $subscription->is_auto_renew ? 'selected' : '' }}>Yes</option>
                                                    <option value="0" {{ !$subscription->is_auto_renew ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="premium-label">CANCELLATION REASON</label>
                                            <textarea name="cancellation_reason" class="form-control premium-input" rows="2">{{ $subscription->cancellation_reason }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0 pb-4 px-4">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn-glow" style="padding: 0.5rem 1.2rem;">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-credit-card fs-1 text-muted"></i>
                                <h5 class="mt-3">No subscriptions found</h5>
                                <p class="text-muted">Subscriptions will appear here when users purchase plans.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-4">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection