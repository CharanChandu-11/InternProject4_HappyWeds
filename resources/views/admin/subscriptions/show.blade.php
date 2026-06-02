@extends('layouts.admin')
@section('title', 'Subscription Details - HappilyWeds')

@push('page-styles')
<style>
    /* Same styles as above plus additional detail styles */
    .detail-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .detail-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        margin-bottom: 0.5rem;
    }
    
    .detail-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1e293b;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-5 page-spacing font-sans">
    <div class="animate-card">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="font-serif fw-bold m-0 text-gradient">Subscription Details</h2>
                <p class="text-muted mt-2">View complete subscription information</p>
            </div>
            <a href="{{ route('admin.subscriptions.index') }}" class="btn-glow" style="padding: 0.6rem 1.2rem;">
                <i class="bi bi-arrow-left me-2"></i>Back
            </a>
        </div>
        
        <div class="row">
            <div class="col-md-6">
                <div class="detail-card">
                    <h6 class="detail-label">User Information</h6>
                    <div class="mb-2">
                        <span class="detail-label">Name</span>
                        <p class="detail-value">{{ $subscription->user->name ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Email</span>
                        <p class="detail-value">{{ $subscription->user->email ?? 'N/A' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">User ID</span>
                        <p class="detail-value">#{{ $subscription->user_id }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-card">
                    <h6 class="detail-label">Plan Information</h6>
                    <div class="mb-2">
                        <span class="detail-label">Plan Name</span>
                        <p class="detail-value">{{ $subscription->plan_name }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Plan Type</span>
                        <p class="detail-value">{{ ucfirst($subscription->plan_type) }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Billing Cycle</span>
                        <p class="detail-value">{{ ucfirst($subscription->billing_cycle) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-card">
                    <h6 class="detail-label">Payment Details</h6>
                    <div class="mb-2">
                        <span class="detail-label">Amount</span>
                        <p class="detail-value">₹{{ number_format($subscription->amount, 2) }} {{ $subscription->currency }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Payment Method</span>
                        <p class="detail-value">{{ $subscription->payment_method ?? '—' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Transaction ID</span>
                        <p class="detail-value">{{ $subscription->transaction_id ?? '—' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Payment Status</span>
                        <p class="detail-value">{{ ucfirst($subscription->payment_status) }}</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="detail-card">
                    <h6 class="detail-label">Timeline</h6>
                    <div class="mb-2">
                        <span class="detail-label">Starts At</span>
                        <p class="detail-value">{{ $subscription->starts_at ? $subscription->starts_at->format('d M Y, h:i A') : '—' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Ends At</span>
                        <p class="detail-value">{{ $subscription->ends_at ? $subscription->ends_at->format('d M Y, h:i A') : '—' }}</p>
                    </div>
                    <div class="mb-2">
                        <span class="detail-label">Days Remaining</span>
                        <p class="detail-value">{{ $subscription->days_remaining }} days</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection