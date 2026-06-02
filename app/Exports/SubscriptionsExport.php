<?php

namespace App\Exports;

use App\Models\Subscription;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SubscriptionsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Subscription::with(['user', 'profile'])
            ->get()
            ->map(function($subscription) {
                return [
                    'ID' => $subscription->id,
                    'User' => $subscription->user?->name,
                    'Email' => $subscription->user?->email,
                    'Plan' => $subscription->plan_name,
                    'Amount' => $subscription->amount,
                    'Status' => $subscription->status,
                    'Starts At' => $subscription->starts_at?->format('Y-m-d'),
                    'Ends At' => $subscription->ends_at?->format('Y-m-d'),
                    'Created At' => $subscription->created_at?->format('Y-m-d'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID', 'User', 'Email', 'Plan', 'Amount', 
            'Status', 'Starts At', 'Ends At', 'Created At'
        ];
    }
}