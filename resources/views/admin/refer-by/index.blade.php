@extends('layouts.admin')
@section('title', 'Refer By Master - HappilyWeds')

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

    .page-item.disabled .page-link {
        background: rgba(255,255,255,0.4);
        color: #cbd5e1;
        cursor: not-allowed;
        transform: none;
    }

    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .status-active {
        background: #10b98120;
        color: #10b981;
        border: 1px solid #10b98140;
    }

    .status-inactive {
        background: #ef444420;
        color: #ef4444;
        border: 1px solid #ef444440;
    }

    @media (max-width: 576px) {
        .pagination {
            justify-content: center !important;
        }
        .page-link {
            padding: 0.4rem 0.75rem;
            font-size: 0.85rem;
        }
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

<div class="container-fluid py-5 page-spacing font-sans" style="max-width: 1400px;">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Refer By Master</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage referral sources – add, edit, delete, import/export.</p>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn-glow" data-bs-toggle="modal" data-bs-target="#addReferByModal" style="padding: 0.6rem 1.2rem; background: #10b981; box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);">
                <i class="bi bi-plus-circle me-2"></i>Add Refer By
            </button>
            <a href="{{ route('admin.refer-by.export') }}" class="btn-glow" style="padding: 0.6rem 1.2rem;">
                <i class="bi bi-download me-2"></i>Export
            </a>
            <a href="{{ route('admin.refer-by.import.form') }}" class="btn-glow" style="background: #334155; box-shadow: none; padding: 0.6rem 1.2rem;">
                <i class="bi bi-upload me-2"></i>Import
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card delay-1" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Refer By Table -->
    <div class="animate-card delay-2">
        <div class="table-responsive">
            <table class="table premium-table w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $referBy)
                    <tr>
                        <td class="text-muted fw-bold">{{ $index+1 }}</td>
                        <td><span class="fw-bold text-dark">{{ $referBy->name }}</span></td>
                        <td>{{ $referBy->email ?? '—' }}</td>
                        <td>{{ $referBy->phone ?? '—' }}</td>
                        <td>{{ Str::limit($referBy->address, 50) ?? '—' }}</td>
                        <td>
                            @if($referBy->status == 1)
                                <span class="status-badge status-active"><i class="bi bi-check-circle-fill me-1"></i>Active</span>
                            @else
                                <span class="status-badge status-inactive"><i class="bi bi-x-circle-fill me-1"></i>Inactive</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <button type="button" class="action-icon-btn edit" data-bs-toggle="modal" data-bs-target="#editReferByModal{{ $referBy->id }}">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <form action="{{ route('admin.refer-by.destroy', $referBy->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this referral source?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-icon-btn delete"><i class="bi bi-trash3-fill"></i></button>
                            </form>
                        </td>
                    </tr>
                    
                    <!-- Edit Modal for each refer by -->
                    <div class="modal fade modal-premium" id="editReferByModal{{ $referBy->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header border-0 pt-4 px-4">
                                    <h5 class="modal-title fw-bold">Edit Refer By</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('admin.refer-by.update', $referBy->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body px-4">
                                        <div class="mb-3">
                                            <label class="premium-label">NAME *</label>
                                            <input type="text" name="name" class="form-control premium-input" value="{{ $referBy->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="premium-label">EMAIL</label>
                                            <input type="email" name="email" class="form-control premium-input" value="{{ $referBy->email }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="premium-label">PHONE</label>
                                            <input type="text" name="phone" class="form-control premium-input" value="{{ $referBy->phone }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="premium-label">ADDRESS</label>
                                            <textarea name="address" class="form-control premium-input" rows="3">{{ $referBy->address }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="premium-label">STATUS</label>
                                            <select name="status" class="form-control premium-input">
                                                <option value="1" {{ $referBy->status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $referBy->status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
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
                        <td colspan="7" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bi bi-share fs-1 text-muted"></i>
                                <h5 class="mt-3">No referral sources found</h5>
                                <p class="text-muted">Add your first referral source using the button above.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Refer By Modal -->
<div class="modal fade modal-premium" id="addReferByModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="modal-title fw-bold">Add New Refer By</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.refer-by.store') }}" method="POST">
                @csrf
                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label class="premium-label">NAME *</label>
                        <input type="text" name="name" class="form-control premium-input" required>
                    </div>
                    <div class="mb-3">
                        <label class="premium-label">EMAIL</label>
                        <input type="email" name="email" class="form-control premium-input">
                    </div>
                    <div class="mb-3">
                        <label class="premium-label">PHONE</label>
                        <input type="text" name="phone" class="form-control premium-input">
                    </div>
                    <div class="mb-3">
                        <label class="premium-label">ADDRESS</label>
                        <textarea name="address" class="form-control premium-input" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="premium-label">STATUS</label>
                        <select name="status" class="form-control premium-input">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-glow" style="padding: 0.5rem 1.2rem;">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection