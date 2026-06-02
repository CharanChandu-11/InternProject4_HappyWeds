@extends('layouts.admin')
@section('title', 'Gotra Master - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography & Spacing */
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

    /* --- ADVANCED BACKGROUND STYLING --- */
    body { 
        background-color: #f8fafc; 
        position: relative; 
        z-index: 1;
        overflow-x: hidden;
    }

    /* Ambient Pulsing Glow Orbs */
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

    /* Animated Floating SVGs */
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

    /* Page Load Animations */
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }

    /* Premium Form Card */
    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    /* Premium Input Styling */
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

    /* Floating Table Aesthetic */
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

    /* Glowing Premium Buttons */
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

    /* Soft Action Icons */
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
    }

    .action-icon-btn.delete:hover { 
        background: #ef4444; 
        color: white; 
        transform: translateY(-2px); 
        box-shadow: 0 6px 12px rgba(239, 68, 68, 0.25); 
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

<svg class="bg-floating-element" style="top: 12%; right: 8%; width: 220px; --rot-start: 15deg; --rot-mid: 25deg; --duration: 8s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>
<svg class="bg-floating-element" style="bottom: 15%; left: 6%; width: 160px; --rot-start: -20deg; --rot-mid: -5deg; --duration: 10s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>


<div class="container-fluid py-5 page-spacing font-sans" style="max-width: 1000px;">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Gotra Master</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage the lineage and gotra options available for profiles.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.gotras.export') }}" class="btn-glow" style="padding: 0.6rem 1.2rem;"><i class="bi bi-download me-2"></i>Export</a>
            <a href="{{ route('admin.gotras.import.form') }}" class="btn-glow" style="background: #334155; box-shadow: none; padding: 0.6rem 1.2rem;"><i class="bi bi-upload me-2"></i>Import</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card delay-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="premium-card p-4 mb-5 animate-card delay-1">
        <form method="POST" action="{{ route('admin.gotras.store') }}">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-9">
                    <label class="premium-label">Gotra Name</label>
                    <div class="position-relative">
                        <i class="bi bi-bezier2 position-absolute text-muted fs-5" style="left: 15px; top: 12px;"></i>
                        <input type="text" name="gotra" class="form-control premium-input w-100" style="padding-left: 45px;" placeholder="e.g. Kashyap, Bharadwaj, Vatsa" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-glow w-100 d-flex justify-content-center align-items-center" style="height: 48px;">
                        <i class="bi bi-plus-lg me-2"></i> Add Gotra
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="animate-card delay-2">
        <div class="table-responsive" style="overflow-x: auto; padding-bottom: 20px;">
            <table class="table premium-table w-100">
                <thead>
                    <tr>
                        <th width="10%" class="text-center">No.</th>
                        <th width="60%">Gotra Name</th>
                        <th width="15%">Status</th>
                        <th class="text-end pe-4" width="15%">Manage</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td class="text-muted text-center fw-bold fs-6">{{ $loop->iteration }}</td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white bg-gradient-signature" style="width: 40px; height: 40px; font-size: 1.1rem;">
                                        <i class="bi bi-diagram-3-fill"></i>
                                    </div>
                                    <span class="fw-bold text-dark fs-5 text-capitalize">
                                        {{ $row->gotra }}
                                    </span>
                                </div>
                            </td>

                            <td>
                                @if($row->status)
                                    <span class="badge rounded-pill fw-bold border border-success-subtle" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 6px 14px;">Active</span>
                                @else
                                    <span class="badge rounded-pill fw-bold border border-danger-subtle" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; padding: 6px 14px;">Inactive</span>
                                @endif
                            </td>

                            <td class="text-end pe-4">
                                <form action="{{ route('admin.gotras.destroy', $row->id) }}" method="POST" class="m-0 p-0" onsubmit="return confirm('Are you sure you want to delete this gotra entry?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="action-icon-btn delete" title="Delete Gotra">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 bg-transparent shadow-none border-0">
                                <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                    <div class="rounded-circle bg-white shadow-sm d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                                        <i class="bi bi-bezier2 text-muted" style="font-size: 2.5rem;"></i>
                                    </div>
                                    <h4 class="font-serif fw-bold text-dark">No Gotras Found</h4>
                                    <p class="text-muted fw-medium fs-6">Use the form above to add your first gotra option.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection