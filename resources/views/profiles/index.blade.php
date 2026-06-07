@extends('layouts.admin')

@section('title', 'Profiles List - HappilyWeds')

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

    .animate-card { animation: fadeSlideUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards; opacity: 0; }
    @keyframes fadeSlideUp {
        0% { opacity: 0; transform: translateY(25px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* Premium Cards */
    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    /* Glowing Premium Buttons */
    .btn-premium {
        border-radius: 14px;
        padding: 0.7rem 1.8rem;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
        position: relative;
    }

    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }

    .btn-premium-outline {
        background: #ffffff;
        border: 2px solid #e2e8f0;
        color: #475569;
    }

    .btn-premium-outline:hover {
        border-color: #111111;
        color: #111111;
        background: #f8fafc;
    }

    /* Premium Form Inputs */
    .premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.7rem 1.2rem;
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

    .filter-label, .edit-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: block;
    }


    .split-layout {
        display: flex;
        height: calc(100vh - 140px);
        min-height: 800px;
        margin-bottom: 40px;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    /* Eye Button on List Items */
    .list-action-icons {
        display: flex;
        gap: 5px;
        margin-left: 10px;
    }

    .list-view-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .list-item:hover .list-view-icon {
        background: var(--brand-pink-light, rgba(231, 84, 128, 0.1));
        color: #e75480;
    }

    .list-item.active .list-view-icon {
        background: rgba(255, 255, 255, 0.2) !important;
        color: #ffffff !important;
    }
    
    /* INITIAL STATE: List only, wide view */
    .split-layout.list-only-mode .profile-list-pane {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .split-layout.list-only-mode .profile-detail-pane {
        display: none;
        opacity: 0;
        width: 0;
    }

    .split-layout.list-only-mode .list-item {
        padding: 20px 30px;
        margin: 0 15px 8px 15px;
    }

    /* --- LEFT PANE (LIST) --- */
    .profile-list-pane {
        width: 350px;
        flex-shrink: 0;
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: width 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), max-width 0.4s ease;
    }

    .list-header {
        display: flex;
        justify-content: space-between;
        padding: 20px 25px;
        background: #fdfafb;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.75rem;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .list-scroll-area {
        flex: 1;
        overflow-y: auto;
        padding: 10px 0;
    }
    .list-scroll-area::-webkit-scrollbar { width: 5px; }
    .list-scroll-area::-webkit-scrollbar-thumb { background-color: #e2e8f0; border-radius: 10px; }

    .list-item {
        display: flex;
        align-items: center;
        padding: 14px 20px;
        margin: 0 10px 5px 10px;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.2s;
        border: 1px solid transparent;
        background: transparent;
    }
    
    .list-item:hover { 
        background: #f8fafc; 
        border-color: #f1f5f9;
    }
    
    /* CUSTOM GRADIENT ACTIVE STATE */
    .list-item.active {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.25);
        color: #ffffff;
        transform: scale(1.02);
    }

    /* Force text white when active */
    .list-item.active .list-name,
    .list-item.active .list-id,
    .list-item.active .list-loc {
        color: #ffffff !important;
    }
    
    .list-item.active .list-loc i {
        color: #ff9fb8 !important;
    }

    /* Alter Avatar when active */
    .list-item.active .list-avatar {
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: #ffffff;
    }

    .list-id {
        font-size: 0.8rem;
        font-weight: 700;
        color: #94a3b8;
        width: 35px;
        transition: color 0.2s;
    }

    .list-avatar {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: linear-gradient(135deg, #2a1625 0%, #6d2c43 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        margin: 0 15px;
        flex-shrink: 0;
        transition: all 0.2s;
    }

    .list-info { flex: 1; min-width: 0; }
    .list-name { margin: 0; font-size: 1rem; font-weight: 700; color: #111827; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; transition: color 0.2s; }
    .list-loc { font-size: 0.75rem; color: #6b7280; display: flex; align-items: center; gap: 4px; margin-top: 4px; font-weight: 500; transition: color 0.2s;}
    .list-loc i { color: #e75480; transition: color 0.2s;}

    /* --- RIGHT PANE (DETAILS) --- */
    /* --- RIGHT PANE (DETAILS) --- */
    .profile-detail-pane {
        flex: 1;
        margin-left: 50px !important; /* Forces the gap from the left sidebar */
        background: #faf7f8; 
        border-radius: 24px;
        border: 1px solid rgba(231, 84, 128, 0.1);
        overflow-y: auto;
        padding: 30px;
        position: relative;
        animation: fadeInRight 0.4s ease forwards;
    }
    
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .profile-detail-pane::-webkit-scrollbar { width: 6px; }
    .profile-detail-pane::-webkit-scrollbar-thumb { background-color: rgba(231, 84, 128, 0.2); border-radius: 10px; }

    .view-mode, .edit-mode {
        animation: fadeIn 0.4s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* Right Pane - Top Hero Card */
    .detail-hero-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 35px;
        display: flex;
        gap: 35px;
        box-shadow: 0 10px 40px rgba(231, 84, 128, 0.05);
        margin-bottom: 30px;
        position: relative;
        overflow: hidden;
    }

    .detail-img-box {
        width: 200px;
        height: 240px;
        background: #9ca3af; 
        border-radius: 20px;
        overflow: hidden;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .detail-img-box img { width: 100%; height: 100%; object-fit: cover; }
    .detail-img-box i { font-size: 6rem; color: #ffffff; opacity: 0.5; }

    .detail-info { flex: 1; display: flex; flex-direction: column; justify-content: center; z-index: 2; }
    
    .detail-badge-id {
        display: inline-flex;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 15px;
        width: fit-content;
    }

    .detail-name { 
        font-family: 'Playfair Display', serif; 
        font-size: 3rem; 
        font-weight: 700; 
        color: #111827; 
        margin-bottom: 15px; 
        line-height: 1.1; 
    }
    
    .detail-stats {
        display: flex;
        gap: 25px;
        margin-bottom: 25px;
        color: #6b7280;
        font-size: 0.95rem;
        font-weight: 500;
        flex-wrap: wrap;
    }
    .detail-stats span { display: flex; align-items: center; gap: 6px; }
    .detail-stats i { color: #e75480; }

    .detail-bio {
        font-size: 0.95rem;
        color: #6b7280;
        font-style: italic;
        margin-bottom: 30px;
    }

    .detail-actions { display: flex; gap: 15px; flex-wrap: wrap; }
    
    .btn-action-solid {
        background: linear-gradient(135deg, #e75480 0%, #ff7eb3 100%);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s;
        box-shadow: 0 6px 20px rgba(231, 84, 128, 0.3);
        text-decoration: none;
    }
    .btn-action-solid:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(231, 84, 128, 0.4); color: white; }

    .btn-action-outline {
        background: #ffffff;
        color: #e75480;
        border: 2px solid #fdf2f5;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
        cursor: pointer;
    }
    .btn-action-outline:hover { background: #fdf2f5; border-color: #e75480; }

    /* Accordions */
    .detail-accordion { margin-bottom: 20px; }
    .detail-accordion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        cursor: pointer;
        border-bottom: 1px solid rgba(231, 84, 128, 0.15);
        color: #e75480;
        font-weight: 700;
        font-size: 1.2rem;
        user-select: none;
    }
    .detail-accordion-header i { transition: transform 0.3s; }
    .detail-accordion-header.collapsed i { transform: rotate(-90deg); }

    .detail-accordion-body {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        margin-top: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px 20px;
    }

    .data-item { display: flex; flex-direction: column; gap: 6px; }
    .data-item-header { display: flex; align-items: center; gap: 8px; color: #94a3b8; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; }
    .data-item-header i { color: #fecdd3; font-size: 1.1rem; }
    .data-value { font-size: 1.05rem; font-weight: 700; color: #111827; padding-left: 26px; } 

    /* Edit Mode Styling Overrides */
    .edit-mode .detail-hero-card { flex-direction: column; gap: 15px; }
    .edit-mode .data-item { margin-bottom: 5px; }

    /* MATCHES SECTION STYLING */
    .matches-section {
        margin-top: 50px;
        padding-top: 40px;
        border-top: 1px solid rgba(231, 84, 128, 0.15);
    }
    .matches-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 25px;
    }
    .matches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }
    .match-mini-card {
        background: #ffffff;
        border: 1px solid rgba(231, 84, 128, 0.1);
        border-radius: 20px;
        overflow: hidden;
        transition: transform 0.3s ease, border-color 0.3s ease;
        cursor: pointer;
        text-align: center;
        padding-bottom: 20px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }
    .match-mini-card:hover {
        transform: translateY(-5px);
        border-color: var(--brand-pink);
        box-shadow: 0 10px 25px rgba(231, 84, 128, 0.15);
    }
    .match-mini-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .match-mini-info {
        padding: 15px 15px 10px;
    }
    .match-mini-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .match-mini-details {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 12px;
    }
    .match-score-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(231, 84, 128, 0.1);
        color: #e75480;
        font-size: 0.85rem;
        font-weight: 700;
        padding: 6px 14px;
        border-radius: 50px;
    }

    .match-score-tooltip strong {
        display: block;
        font-size: 0.75rem;
        color: #e75480;
        margin-top: 10px;
        margin-bottom: 5px;
    }

    .match-score-breakdown {
        padding: 0;
        margin: 0;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 5px;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
    }

    .match-score-breakdown::-webkit-scrollbar {
        display: none;
    }

    .match-score-breakdown li {
        list-style: none;
        color: #000000;
        font-size: 0.85rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .match-score-breakdown li::after{
        content: '';
        display: inline-block;
        width: 5px;
        height: 5px;
        background: #e75480;
        border-radius: 50%;
        margin-left: 5px;
    }

    @media (max-width: 991px) {
        .split-layout { flex-direction: column; height: auto; }
        .split-layout.list-only-mode .profile-list-pane { width: 100%; }
        .profile-list-pane { width: 100%; height: 500px; }
        .detail-hero-card { flex-direction: column; align-items: center; text-align: center; }
        .detail-info { align-items: center; }
        .detail-stats { justify-content: center; }
        .detail-accordion-body { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .detail-accordion-body { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="bg-glow-orb orb-1"></div>
<div class="bg-glow-orb orb-2"></div>

<div class="container-fluid py-5 page-spacing font-sans">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Profiles Directory</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Manage, search, and curate your candidate profiles.</p>
        </div>

        <a href="{{ route('admin.profiles.create') }}" class="btn-premium btn-glow shadow-sm d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-plus-lg me-2 border border-white rounded-circle d-flex align-items-center justify-content-center" style="width: 20px; height: 20px; font-size: 0.7rem;"></i> 
            Add New Profile
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm animate-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #10b981; border-radius: 16px; border-left: 4px solid #10b981;">
            <i class="bi bi-check-circle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm animate-card" style="background: rgba(255,255,255,0.9); backdrop-filter: blur(5px); color: #ef4444; border-radius: 16px; border-left: 4px solid #ef4444;">
            <i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i>
            <span class="fw-bold">Please fix the errors below.</span>
        </div>
    @endif
    <div class="premium-card mb-4 animate-card delay-1">
        <div class="card-body p-4">
            <h6 class="font-serif fw-bold mb-3 text-dark d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#importExportSection" style="cursor:pointer;">
                <i class="bi bi-upload text-pink me-2" style="color: #e75480;"></i> Import & Export <i class="bi bi-chevron-down ms-auto text-muted"></i>
            </h6>
            <div class="row g-4 mb-5 animate-card delay-1 collapse" id="importExportSection">
                <div class="col-md-6">
                    <div class="premium-card p-4 p-lg-5 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 50px; height: 50px; background: rgba(231, 84, 128, 0.1); color: #e75480; font-size: 1.5rem;">
                                <i class="bi bi-cloud-upload-fill"></i>
                            </div>
                            <h5 class="font-serif fw-bold text-dark mb-2">Import Profiles</h5>
                            <p class="text-muted fw-medium mb-4" style="font-size: 0.95rem;">Upload a bulk list of profiles via spreadsheet.</p>
                        </div>

                        <form action="{{ route('admin.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <input type="file" name="file" class="form-control premium-input" required>
                                <small class="text-muted mt-2 d-block fw-semibold">
                                    Allowed formats: <span class="badge bg-light text-dark border">.xlsx</span> <span class="badge bg-light text-dark border">.csv</span>
                                </small>
                            </div>
                            <button type="submit" class="btn-premium btn-glow w-100">Import Data</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="premium-card p-4 p-lg-5 h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3" style="width: 50px; height: 50px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; font-size: 1.5rem;">
                                <i class="bi bi-cloud-download-fill"></i>
                            </div>
                            <h5 class="font-serif fw-bold text-dark mb-2">Export Profiles</h5>
                            <p class="text-muted fw-medium mb-4" style="font-size: 0.95rem;">Download all existing profiles into an Excel spreadsheet for offline backup or deep analysis.</p>
                        </div>

                        <a href="{{ route('admin.export') }}" class="btn-premium btn-premium-outline w-100 text-center text-decoration-none mt-auto d-flex justify-content-center align-items-center">
                            <i class="bi bi-file-earmark-excel-fill fs-5 me-2 text-success"></i> Download Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card mb-4 animate-card delay-1">
        <div class="card-body p-4">
            <h6 class="font-serif fw-bold mb-3 text-dark d-flex align-items-center" data-bs-toggle="collapse" data-bs-target="#filterForm" style="cursor:pointer;">
                <i class="bi bi-funnel-fill text-pink me-2" style="color: #e75480;"></i> Search & Filters <i class="bi bi-chevron-down ms-auto text-muted"></i>
            </h6>
            
            <form method="GET" action="{{ route('admin.profiles.index') }}" id="filterForm" class="collapse {{ request()->anyFilled(['name', 'gender', 'marital_status', 'caste', 'birth_place', 'dob_from', 'dob_to', 'min_income', 'max_income', 'referenced_by']) ? 'show' : '' }}">
                <div class="row g-3 align-items-end pt-2">
                    <div class="col-md-3">
                        <label class="filter-label">Full Name</label>
                        <input type="text" name="name" class="form-control premium-input" placeholder="e.g. Rahul" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Gender</label>
                        <select name="gender" class="form-select premium-input">
                            <option value="">Any</option>
                            <option value="Male" {{ request('gender')=='Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ request('gender')=='Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="filter-label">Marital Status</label>
                        <select name="marital_status" class="form-select premium-input">
                            <option value="">Any</option>
                            <option value="Single" {{ request('marital_status')=='Single' ? 'selected' : '' }}>Single</option>
                            <option value="Separated" {{ request('marital_status')=='Separated' ? 'selected' : '' }}>Separated</option>
                            <option value="Divorced" {{ request('marital_status')=='Divorced' ? 'selected' : '' }}>Divorced</option>    
                            <option value="Widowed" {{ request('marital_status')=='Widowed' ? 'selected' : '' }}>Widowed</option>
                            <option value="Awaiting Divorce" {{ request('marital_status')=='Awaiting Divorce' ? 'selected' : '' }}>Awaiting Divorce</option>
                            <option value="Married" {{ request('marital_status')=='Married' ? 'selected' : '' }}>Married</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="premium-label">Referenced By</label>
                        <select name="registered_by" class="form-select premium-input">
                            <option value="">All</option>
                            @foreach($references as $pcb)
                                <option value="{{ $pcb->id }}" {{ old('registered_by', $profile->registered_by ?? '') == $pcb->id ? 'selected' : '' }}>
                                    {{ mb_convert_case(str_replace('_', ' ', $pcb->name), MB_CASE_TITLE, 'UTF-8') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="filter-label">Location</label>
                        <input type="text" name="birth_place" class="form-control premium-input" placeholder="City" value="{{ request('birth_place') }}">
                    </div>

                    <div class="col-md-4">
                        <label class="filter-label">Date of Birth</label>
                        <div class="d-flex gap-2">
                            <input type="date" name="dob_from" class="form-control premium-input" placeholder="From" value="{{ request('dob_from') }}">
                            <input type="date" name="dob_to" class="form-control premium-input" placeholder="To" value="{{ request('dob_to') }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="filter-label">Annual Income</label>
                        <div class="d-flex gap-2">
                            <input type="number" name="min_income" class="form-control premium-input" placeholder="Min" value="{{ request('min_income') }}">
                            <input type="number" name="max_income" class="form-control premium-input" placeholder="Max" value="{{ request('max_income') }}">
                        </div>
                    </div>

                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn-glow btn flex-grow-1 px-0 d-flex justify-content-center align-items-center">
                            <i class="bi bi-search"></i>
                        </button>
                        <a href="{{ route('admin.profiles.index') }}" class="btn btn-light border flex-grow-1 px-0 d-flex justify-content-center align-items-center" title="Reset">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @php
        // Identify the Selected Profile logic
        $selectedId = request('selected');
        $selectedProfile = null;
        
        if ($profiles->count() > 0) {
            if ($selectedId) {
                $selectedProfile = collect($profiles->items())->firstWhere('id', $selectedId);
            }
            if (!$selectedProfile) {
                $selectedProfile = $profiles->items()[0];
            }
        }
    @endphp

    <div class="split-layout list-only-mode animate-card delay-2" id="mainSplitLayout">
        
        {{-- VIEW TOGGLE BUTTONS --}}
    <div class="d-flex justify-content-end mb-3 animate-card delay-1">
        <div class="btn-group shadow-sm border" style="border-radius: 12px; overflow: hidden;" role="group">
            <button type="button" class="btn btn-dark active" id="btnListView" onclick="toggleViewMode('list')" style="font-size: 0.85rem; font-weight: 600;">
                <i class="bi bi-layout-split me-1"></i> Card View
            </button>
            <button type="button" class="btn btn-light text-secondary" id="btnTableView" onclick="toggleViewMode('table')" style="font-size: 0.85rem; font-weight: 600;">
                <i class="bi bi-table me-1"></i> Table View
            </button>
        </div>
    </div>

    {{-- TABLE VIEW CONTAINER (Hidden by default) --}}
    <div id="tableViewContainer" class="premium-card p-0 d-none mb-5 animate-card delay-2 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" style="font-size: 0.9rem;">
                <thead class="table-light" style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">
                    <tr>
                        <th class="ps-4 py-3 text-secondary">ID</th>
                        <th class="py-3 text-secondary">Candidate Name</th>
                        <th class="py-3 text-secondary">Age</th>
                        <th class="py-3 text-secondary">Location</th>
                        <th class="py-3 text-secondary">Income</th>
                        <th class="py-3 text-secondary">Membership</th>
                        <th class="py-3 text-secondary">Refer By</th>
                        <th class="pe-4 py-3 text-secondary text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profiles as $pt)
                        @php
                            $ptName = !empty($pt->first_name) ? trim($pt->first_name.' '.$pt->last_name) : 'Candidate '.$pt->id;
                            $ptAge = $pt->dob ? \Carbon\Carbon::parse($pt->dob)->age . ' yrs' : '—';
                            $ptIncome = $pt->annual_income ? '₹'.number_format($pt->annual_income) : '—';
                            $ptMem = ucfirst($pt->membership_type ?? 'Free');
                            
                            $ptRefName = 'Direct';
                            if ($pt->registered_by) {
                                $ref = collect($references)->firstWhere('id', $pt->registered_by);
                                $ptRefName = $ref ? mb_convert_case(str_replace('_', ' ', $ref->name), MB_CASE_TITLE, 'UTF-8') : 'Direct';
                            }
                        @endphp
                        <tr>
                            <td class="ps-4 fw-bold text-muted">#{{ $pt->id }}</td>
                            <td class="fw-bold text-dark">{{ $ptName }}</td>
                            <td>{{ $ptAge }}</td>
                            <td>{{ $pt->city ?? ($pt->birth_place ?? '—') }}</td>
                            <td class="fw-semibold text-success">{{ $ptIncome }}</td>
                            <td><span class="badge rounded-pill" style="background: #e75480; font-weight: 600;">{{ $ptMem }}</span></td>
                            <td class="text-muted"><i class="bi bi-person-lines-fill me-1"></i>{{ $ptRefName }}</td>
                            <td class="pe-4 text-end">
                                <a href="{{ route('admin.profiles.edit', $pt->id) }}" class="btn btn-sm btn-light border text-primary rounded-circle me-1" title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                <form method="POST" action="{{ route('admin.profiles.destroy', $pt->id) }}" onsubmit="return confirm('Delete this profile?');" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border text-danger rounded-circle" title="Delete"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center py-5 text-muted"><i class="bi bi-search fs-3 d-block mb-2"></i>No profiles found</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($profiles->hasPages())
            <div class="p-3 border-top bg-light">
                {{ $profiles->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>

    {{-- EXISTING SPLIT LAYOUT (List View) --}}
    <div class="split-layout list-only-mode animate-card delay-2" id="mainSplitLayout">
        
        <div class="profile-list-pane">
            <div class="list-header">
                <span>Directory</span>
                <span>{{ $profiles->total() }} Found</span>
            </div>
            
            <div class="list-scroll-area">
                @forelse ($profiles as $profileLoop)
                    @php
                        $isActive = $selectedProfile && $selectedProfile->id == $profileLoop->id;
                        $initial = substr($profileLoop->first_name ?? 'U', 0, 1);
                        $listName = !empty($profileLoop->first_name) ? trim($profileLoop->first_name.' '.$profileLoop->last_name) : 'Candidate '.$profileLoop->id;
                        $listLoc = !empty($profileLoop->city) ? $profileLoop->city : ($profileLoop->birth_place ?? 'Location Unknown');
                        
                        // --- NEW CARD DETAILS ---
                        $age = $profileLoop->dob ? \Carbon\Carbon::parse($profileLoop->dob)->age . ' yrs' : 'N/A';
                        $income = $profileLoop->annual_income ? '₹'.number_format($profileLoop->annual_income) : 'N/A';
                        $membership = ucfirst($profileLoop->membership_type ?? 'Free');
                        
                        $referByName = 'Direct';
                        if ($profileLoop->registered_by) {
                            $ref = collect($references)->firstWhere('id', $profileLoop->registered_by);
                            $referByName = $ref ? mb_convert_case(str_replace('_', ' ', $ref->name), MB_CASE_TITLE, 'UTF-8') : 'Direct';
                        }
                    @endphp

                    <div class="list-item align-items-stretch" id="list-item-{{ $profileLoop->id }}" onclick="showProfileDetails({{ $profileLoop->id }}, this, 'view')">
                        
                        <div class="list-avatar mt-1">{{ strtoupper($initial) }}</div>
                        
                        <div class="list-info w-100 pe-2" style="min-width: 0;">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h4 class="list-name mb-0 text-truncate" style="max-width: 65%;">{{ $listName }}</h4>
                                <span class="badge" style="background: #e75480; font-size: 0.6rem; letter-spacing: 0.5px;">{{ $membership }}</span>
                            </div>
                            
                            <div class="list-loc"><i class="bi bi-geo-alt-fill"></i> {{ strtoupper($listLoc) }}</div>
                            
                            {{-- NEW MINI DATA BADGES --}}
                            <div class="d-flex flex-wrap gap-2 mt-2" style="font-size: 0.7rem; color: #64748b; font-weight: 600;">
                                <span class="bg-white border px-2 py-1 rounded text-dark"><i class="bi bi-calendar3 me-1" style="color: #e75480;"></i>{{ $age }}</span>
                                <span class="bg-white border px-2 py-1 rounded text-dark"><i class="bi bi-wallet2 me-1" style="color: #e75480;"></i>{{ $income }}</span>
                                <span class="bg-white border px-2 py-1 rounded text-dark"><i class="bi bi-person-lines-fill me-1" style="color: #e75480;"></i>{{ $referByName }}</span>
                            </div>
                        </div>

                        <div class="list-action-icons d-flex flex-column justify-content-center gap-1 ms-1 border-start ps-2">
                            <div class="list-view-icon" style="width: 28px; height: 28px; font-size: 0.8rem;" title="View Profile" onclick="showProfileDetails({{ $profileLoop->id }}, this.closest('.list-item'), 'view'); event.stopPropagation();">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <a class="list-view-icon" style="width: 28px; height: 28px; font-size: 0.8rem;" title="Edit Profile" href="{{ route('admin.profiles.edit', $profileLoop->id) }}" >
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.profiles.destroy', $profileLoop->id) }}" onsubmit="return confirm('Are you sure you want to delete this profile?');" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="list-view-icon" title="Delete Profile" style="width: 28px; height: 28px; font-size: 0.8rem; background: none; border: none; padding: 0; margin: 0; cursor: pointer;">
                                    <i class="bi bi-trash-fill text-danger"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-5 text-center text-muted mt-5">
                        <i class="bi bi-search fs-1 mb-3 d-block" style="color: #cbd5e1;"></i>
                        <h5>No profiles found</h5>
                        <p class="small">Try adjusting your filters to see more results.</p>
                    </div>
                @endforelse
            </div>
            
            @if($profiles->hasPages())
                <div class="p-3 border-top" style="background: #f8fafc;">
                    {{ $profiles->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

        <div class="profile-detail-pane" id="detailContainer">
            
            @foreach($profiles as $profileDetail)
                @php
                    // Map real DB data
                    $dp = [
                        'id' => $profileDetail->id,
                        'profile_id' => 'HW-'.$profileDetail->id,
                        'name' => trim($profileDetail->first_name.' '.$profileDetail->last_name) ?: 'Candidate '.$profileDetail->id,
                        'age' => $profileDetail->age ?? '—',
                        'height' => $profileDetail->height_feet ? $profileDetail->height_feet."' ".$profileDetail->height_inch."\"" : '—',
                        'religion' => $profileDetail->religion ?? '—',
                        'location' => $profileDetail->city ?? ($profileDetail->birth_place ?? '—'),
                        'about' => $profileDetail->about_myself ?? 'No bio provided yet.',
                        'image' => $profileDetail->profile_photo ? asset('public/storage/'.$profileDetail->profile_photo) : null,
                        'gender' => ucfirst($profileDetail->gender ?? '—'),
                        'marital_status' => $profileDetail->marital_status ?? '—',
                        'dob' => $profileDetail->dob ? \Carbon\Carbon::parse($profileDetail->dob)->format('d M Y') : '—',
                        'mother_tongue' => $profileDetail->mother_tongue ?? '—',
                        'diet' => $profileDetail->diet ?? '—',
                        'blood_group' => $profileDetail->blood_group ?? '—',
                        'caste' => $profileDetail->caste ?? '—',
                        'gotra' => $profileDetail->gotra ?? '—',
                        'mangal_dosh' => ucfirst($profileDetail->mangal_dosh ?? '—'),
                        'highest_qualification' => $profileDetail->highest_qualification ?? '—',
                        'profession' => $profileDetail->occupation ?? '—',
                        'company' => $profileDetail->company_name ?? '—',
                        'income' => $profileDetail->annual_income ? '₹ '.$profileDetail->annual_income : '—',
                        'family_type' => $profileDetail->family_type ?? '—',
                        'family_status' => $profileDetail->family_status ?? '—',
                        'father_occupation' => $profileDetail->father_occupation ?? '—',
                        'mother_occupation' => $profileDetail->mother_occupation ?? '—',
                        'brothers' => $profileDetail->no_of_brothers ?? 0,
                        'sisters' => $profileDetail->no_of_sisters ?? 0,
                        'partner_age' => ($profileDetail->partner_min_age ?? '?').' - '.($profileDetail->partner_max_age ?? '?').' Years',
                        'partner_height' => ($profileDetail->partner_min_height ?? '?').' - '.($profileDetail->partner_max_height ?? '?').' cm',
                        'partner_marital_status' => !empty($profileDetail->partner_marital_status)
                                    ? implode(', ', (array) $profileDetail->partner_marital_status)
                                    : "Doesn't Matter",

                        'partner_religion' => 
                                    (!empty($profileDetail->partner_religion)
                                        ? implode(', ', (array) $profileDetail->partner_religion)
                                        : 'Any')
                                    .' / '.
                                    (!empty($profileDetail->partner_caste)
                                        ? implode(', ', (array) $profileDetail->partner_caste)
                                        : 'Any'),
                        'partner_education' => $profileDetail->partner_education ?? 'Doesn\'t Matter',
                        'partner_location' => is_array($profileDetail->area_preference) ? implode(', ', $profileDetail->area_preference) : ($profileDetail->area_preference ?? 'Doesn\'t Matter')
                    ];

                    // Fallback for completely empty test database entries
                    if(empty($profileDetail->first_name)) {
                        $dp['name'] = 'Roopam Bansal'; $dp['age'] = 28; $dp['height'] = "5'4\"";
                        $dp['religion'] = 'Hinduism'; $dp['location'] = 'SANGRUR'; $dp['gender'] = 'Female';
                        $dp['marital_status'] = 'Single'; $dp['dob'] = '25 Jan 1998'; $dp['mother_tongue'] = 'Hindi';
                        $dp['diet'] = 'Vegetarian'; $dp['blood_group'] = 'O+';
                        $dp['highest_qualification'] = 'MBA'; $dp['profession'] = 'Marketing'; $dp['company'] = 'MNC'; $dp['income'] = '₹ 12,00,000';
                        $dp['family_type'] = 'Joint'; $dp['family_status'] = 'Middle Class'; $dp['father_occupation'] = 'Business'; $dp['mother_occupation'] = 'Housewife'; $dp['brothers'] = '1'; $dp['sisters'] = '1';
                        $dp['partner_age'] = '28 - 32'; $dp['partner_height'] = '5\'6" - 6\'0"'; $dp['partner_marital_status'] = 'Single'; $dp['partner_religion'] = 'Hinduism / Baniya'; $dp['partner_education'] = 'Post Graduate'; $dp['partner_location'] = 'Delhi, Mumbai, Pune';
                    }

                    // --- GENERATE DUMMY MATCHES FOR THIS PROFILE ---
                    $stockImages = [
                        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop',
                        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop',
                        'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?w=400&h=500&fit=crop',
                        'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&h=500&fit=crop',
                        'https://images.unsplash.com/photo-1534751516642-a1af1ef26a56?w=400&h=500&fit=crop'
                    ];
                    shuffle($stockImages);

                    $potentialMatches = App\Models\Profile::where('id', '!=', $profileDetail->id)
                        ->where('gender', $profileDetail->gender == 'male' ? 'female' : 'male')
                        ->get();

                    $availableMatches = $potentialMatches->map(function($match) use ($profileDetail) {
                                // Calculate match score
                                $matchScore = $profileDetail->getMatchScore($match, true); // Pass 'true' to get detailed scoring breakdown
                                
                                // Save match score to database for future use (optional)
                                if ($match->match_score != $matchScore['percentage']) {
                                    $match->match_score = $matchScore['percentage'];
                                    $match->saveQuietly(); // Save without triggering events
                                }
                                
                                $match->calculated_match_score = $matchScore['percentage']; // Overall match percentage
                                $match->match_details = implode(',',$matchScore['points']); // Detailed breakdown for tooltip
                                return $match;
                            })
                            ->filter(function($match) {
                                // Only show matches with score >= 50 (adjust as needed)
                                return $match->calculated_match_score > 50;
                            })
                            ->sortByDesc('calculated_match_score');
                    
                    // $availableMatches = collect($profiles->items())->filter(function($p) use ($profileDetail) {
                    //     return $p->id !== $profileDetail->id;
                    // })->take(3)->values();
                @endphp

                <div class="profile-detail-content" id="detail-content-{{ $profileDetail->id }}" style="display: none;">
                    
                    <div id="view-mode-{{ $profileDetail->id }}" class="view-mode">
                        <div class="detail-hero-card">
                            <div class="detail-img-box">
                                @if($dp['image'])
                                    <img src="{{ $dp['image'] }}" alt="Profile">
                                @else
                                    <i class="bi bi-person-fill"></i>
                                @endif
                            </div>
                            
                            <div class="detail-info">
                                <div class="detail-badge-id">
                                    <i class="bi bi-fingerprint me-1"></i> {{ $dp['profile_id'] }}
                                </div>
                                
                                <h1 class="detail-name">{{ $dp['name'] }}</h1>
                                
                                <div class="detail-stats">
                                    <span><i class="bi bi-calendar"></i> ~{{ $dp['age'] }} Years</span>
                                    <span><i class="bi bi-arrows-vertical"></i> {{ $dp['height'] }}</span>
                                    <span><i class="bi bi-moon-stars"></i> {{ $dp['religion'] }}</span>
                                    <span><i class="bi bi-geo-alt"></i> {{ $dp['location'] }}</span>
                                </div>

                                <p class="detail-bio">"{{ $dp['about'] }}"</p>

                                <div class="detail-actions">
                                    <button class="btn-action-solid"><i class="bi bi-heart-fill"></i> Send Interest</button>
                                    <a href="/messages/chat/{{$dp['id']}}" class="btn-action-outline"><i class="bi bi-chat-dots-fill"></i> Message</a>
                                    <button type="button" class="btn-action-outline text-muted border-secondary" onclick="toggleEditMode({{ $profileDetail->id }}, 'edit')">
                                        <i class="bi bi-pencil-square"></i> Inline Edit
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="detail-accordion">
                            <div class="detail-accordion-header" data-bs-toggle="collapse" data-bs-target="#viewBasic-{{$dp['id']}}" aria-expanded="true">
                                <span>Basic Information</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div id="viewBasic-{{$dp['id']}}" class="collapse show detail-accordion-body">
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-gender-ambiguous"></i> Gender</div><div class="data-value">{{ $dp['gender'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-people"></i> Marital Status</div><div class="data-value">{{ $dp['marital_status'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-calendar-event"></i> Date Of Birth</div><div class="data-value">{{ $dp['dob'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-translate"></i> Mother Tongue</div><div class="data-value">{{ $dp['mother_tongue'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-cup-hot"></i> Diet</div><div class="data-value">{{ $dp['diet'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-droplet"></i> Blood Group</div><div class="data-value">{{ $dp['blood_group'] }}</div></div>
                            </div>
                        </div>

                        <div class="detail-accordion">
                            <div class="detail-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#viewAstro-{{$dp['id']}}" aria-expanded="false">
                                <span>Religious & Astrological Background</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div id="viewAstro-{{$dp['id']}}" class="collapse detail-accordion-body">
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-book"></i> Religion</div><div class="data-value">{{ $dp['religion'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-diagram-3"></i> Caste</div><div class="data-value">{{ $dp['caste'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-bezier2"></i> Gotra</div><div class="data-value">{{ $dp['gotra'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-exclamation-triangle"></i> Mangal Dosh</div><div class="data-value">{{ $dp['mangal_dosh'] }}</div></div>
                            </div>
                        </div>

                        <div class="detail-accordion">
                            <div class="detail-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#viewEdu-{{$dp['id']}}" aria-expanded="false">
                                <span>Education & Profession</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div id="viewEdu-{{$dp['id']}}" class="collapse detail-accordion-body">
                                <div class="data-item" style="grid-column: span 2;"><div class="data-item-header"><i class="bi bi-mortarboard"></i> Highest Education</div><div class="data-value">{{ $dp['highest_qualification'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-briefcase"></i> Occupation</div><div class="data-value">{{ $dp['profession'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-building"></i> Company / Business</div><div class="data-value">{{ $dp['company'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-cash-coin"></i> Annual Income</div><div class="data-value" style="color: var(--brand-pink); font-weight: 700;">{{ $dp['income'] }}</div></div>
                            </div>
                        </div>

                        <div class="detail-accordion">
                            <div class="detail-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#viewFamily-{{$dp['id']}}" aria-expanded="false">
                                <span>Family Details</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div id="viewFamily-{{$dp['id']}}" class="collapse detail-accordion-body">
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-house-door"></i> Family Type</div><div class="data-value">{{ $dp['family_type'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-graph-up-arrow"></i> Family Status</div><div class="data-value">{{ $dp['family_status'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-person-workspace"></i> Father's Occupation</div><div class="data-value">{{ $dp['father_occupation'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-person-hearts"></i> Mother's Occupation</div><div class="data-value">{{ $dp['mother_occupation'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-person-standing"></i> Brothers</div><div class="data-value">{{ $dp['brothers'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-person-standing-dress"></i> Sisters</div><div class="data-value">{{ $dp['sisters'] }}</div></div>
                            </div>
                        </div>

                        <div class="detail-accordion">
                            <div class="detail-accordion-header collapsed" data-bs-toggle="collapse" data-bs-target="#viewPref-{{$dp['id']}}" aria-expanded="false">
                                <span>Partner Preferences</span>
                                <i class="bi bi-chevron-down"></i>
                            </div>
                            <div id="viewPref-{{$dp['id']}}" class="collapse detail-accordion-body" style="background: rgba(231, 84, 128, 0.05);">
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-calendar2-range"></i> Age Preference</div><div class="data-value">{{ $dp['partner_age'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-rulers"></i> Height Preference</div><div class="data-value">{{ $dp['partner_height'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-people"></i> Marital Status</div><div class="data-value">{{ $dp['partner_marital_status'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-book"></i> Religion / Caste</div><div class="data-value">{{ $dp['partner_religion'] }}</div></div>
                                <div class="data-item"><div class="data-item-header"><i class="bi bi-mortarboard"></i> Education</div><div class="data-value">{{ $dp['partner_education'] }}</div></div>
                                <div class="data-item" style="grid-column: span 2;"><div class="data-item-header"><i class="bi bi-geo-alt"></i> Location Preference</div><div class="data-value">{{ $dp['partner_location'] }}</div></div>
                            </div>
                        </div>

                        @if(count($availableMatches) > 0)
                        <div class="matches-section">
                            <h3 class="font-serif">Highly Compatible Matches</h3>
                            <div class="matches-grid">
                                @foreach($availableMatches as $index => $match)
                                    @php
                                        $matchName = !empty($match->first_name) ? trim($match->first_name.' '.$match->last_name) : 'Candidate '.$match->id;
                                        $matchAge = $match->age ?? rand(25, 32);
                                        $matchHeight = $match->height_feet ? $match->height_feet."' ".$match->height_inch."\"" : "5'".rand(3,9)."\"";
                                        $matchScore = $match->calculated_match_score; // Dummy match score
                                    @endphp
                                    <div class="match-mini-card" onclick="showProfileDetails({{ $match->id }}, document.getElementById('list-item-{{ $match->id }}'), 'view')">
                                        <img src="{{ $match->profile_photo_url }}" class="match-mini-img" alt="Profile">
                                        <div class="match-mini-info">
                                            <h5 class="match-mini-name">{{ $matchName }}</h5>
                                            <p class="match-mini-details">{{ $matchAge }} yrs, {{ $matchHeight }}</p>
                                            <span class="match-score-badge"><i class="bi bi-stars"></i> {{ $matchScore }}% Match</span>
                                            <div class="match-score-tooltip">
                                                <strong>Match Compatibility:</strong>
                                                <ul class="match-score-breakdown">
                                                    @foreach(explode(',', $match->match_details) as $detail)
                                                        <li>{{ $detail }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // ==========================================
    // DYNAMIC SPLIT PANE SPA CONTROLLER
    // ==========================================
    // Toggle between Card Split View and Full Table View
    function toggleViewMode(mode) {
        const listLayout = document.getElementById('mainSplitLayout');
        const tableContainer = document.getElementById('tableViewContainer');
        const btnList = document.getElementById('btnListView');
        const btnTable = document.getElementById('btnTableView');

        if (mode === 'table') {
            // Show Table
            listLayout.classList.add('d-none');
            tableContainer.classList.remove('d-none');
            // Update Buttons
            btnTable.classList.add('btn-dark', 'active');
            btnTable.classList.remove('btn-light', 'text-secondary');
            btnList.classList.add('btn-light', 'text-secondary');
            btnList.classList.remove('btn-dark', 'active');
        } else {
            // Show Split Layout
            listLayout.classList.remove('d-none');
            tableContainer.classList.add('d-none');
            // Update Buttons
            btnList.classList.add('btn-dark', 'active');
            btnList.classList.remove('btn-light', 'text-secondary');
            btnTable.classList.add('btn-light', 'text-secondary');
            btnTable.classList.remove('btn-dark', 'active');
        }
    }
    
    function showProfileDetails(profileId, listItemElement, mode = 'view') {
        
        // 1. Trigger layout shift by removing full-width class
        const layout = document.getElementById('mainSplitLayout');
        if (layout.classList.contains('list-only-mode')) {
            layout.classList.remove('list-only-mode');
        }

        // 2. Remove Active state from all list items
        document.querySelectorAll('.list-item').forEach(el => {
            el.classList.remove('active');
        });

        // 3. Add Custom Gradient Active state to clicked item
        if(listItemElement) {
            listItemElement.classList.add('active');
            // Scroll the left sidebar so the active item is in view
            listItemElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        // 4. Hide all pre-rendered detail panes
        document.querySelectorAll('.profile-detail-content').forEach(el => {
            el.style.display = 'none';
        });

        // 5. Show target detail pane and toggle view/edit mode
        const targetDetail = document.getElementById('detail-content-' + profileId);
        if (targetDetail) {
            targetDetail.style.display = 'block';
            toggleEditMode(profileId, mode);
            
            // Scroll right pane to top
            const container = document.getElementById('detailContainer');
            if (container) {
                container.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }

    // Toggle between View and Edit within the same profile pane
    function toggleEditMode(profileId, mode) {
        const viewDiv = document.getElementById('view-mode-' + profileId);
        
        if (mode === 'view') {
            if(viewDiv) viewDiv.style.display = 'block';
        } else {
            if(viewDiv) viewDiv.style.display = 'none';
        }
    }

    // Toggle Accordion chevron rotation
    document.querySelectorAll('.detail-accordion-header').forEach(header => {
        header.addEventListener('click', function() {
            this.classList.toggle('collapsed');
        });
    });
</script>
@endpush