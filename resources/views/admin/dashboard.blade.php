@extends('layouts.admin')

@section('title', 'Admin Dashboard - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography Overrides */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }

    /* The Signature Black-to-Pink Gradient */
    .bg-gradient-signature {
        background: linear-gradient(90deg, #0a0a0a 0%, #e75480 100%);
    }
    
    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Welcome Banner */
    .welcome-banner {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 40px rgba(231, 84, 128, 0.15);
    }
    
    .welcome-banner::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
        pointer-events: none;
    }

    /* Premium Stat Cards */
    .admin-stat-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .admin-stat-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #0a0a0a 0%, #e75480 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: -1;
    }

    .admin-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .admin-stat-card:hover::before {
        transform: scaleX(1);
    }

    /* Icon Boxes */
    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        font-size: 1.5rem;
        transition: all 0.5s ease;
        background: #f8f9fa;
        color: #111;
    }

    .admin-stat-card:hover .icon-box {
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
        color: white;
        transform: rotate(10deg) scale(1.05);
        box-shadow: 0 10px 20px rgba(231, 84, 128, 0.3);
    }

    /* Elegant Table */
    .premium-table-card {
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .premium-table th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: #718096;
        border-bottom: 2px solid #edf2f7;
        padding: 1.2rem 1.5rem;
    }

    .premium-table td {
        vertical-align: middle;
        border-bottom: 1px solid #f7fafc;
        padding: 1.2rem 1.5rem;
        color: #2d3748;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
    }

    .premium-table tbody tr {
        transition: all 0.2s ease;
    }

    .premium-table tbody tr:hover {
        background-color: #fdf2f5;
        transform: scale(1.01);
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    /* Action Pills */
    .action-pill {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        border-radius: 16px;
        background: #ffffff;
        color: #1a202c;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .action-pill:hover {
        background: #111;
        color: #ffffff;
        border-color: #111;
        transform: translateX(8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .action-pill i {
        font-size: 1.4rem;
        margin-right: 15px;
        color: #e75480;
        transition: transform 0.3s ease;
    }

    .action-pill:hover i {
        transform: scale(1.2);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4 py-5 font-sans">
    
    <div class="welcome-banner bg-gradient-signature p-5 mb-5 text-white d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h2 class="font-serif fw-bold mb-2 text-white">Welcome back, Admin.</h2>
            <p class="mb-0 fw-medium" style="opacity: 0.9;">Here is what's happening in your HappilyWeds community today.</p>
        </div>
        <div class="mt-4 mt-md-0">
            <div class="d-flex align-items-center bg-white bg-opacity-10 px-4 py-3 rounded-pill" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                <i class="bi bi-calendar2-heart-fill me-3 fs-5 text-white"></i> 
                <span class="fw-bold text-white tracking-wide">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['total_profiles'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Users</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['total_users'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">New Today</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">+{{ $stats['new_profiles_today'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-stars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Update Today</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['updated_profiles_today'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-pencil-square"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">This Month</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['new_profiles_this_month'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-calendar-month"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-md-4">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Pending</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['pending_profiles'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-clock-history"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Free Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['free_profiles'] ?? 0 }}</h3>   
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-emoji-smile"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Basic Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['basic_profiles'] ?? 0 }}</h3>   
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-asterisk"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Premium Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['premium_profiles'] ?? 0 }}</h3>   
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-star-fill"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">VIP Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['vip_profiles'] ?? 0 }}</h3>   
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-shield-fill-check"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4">
        <div class="col-lg-12">
            <div class="card premium-table-card bg-white h-100 overflow-hidden">
                <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="font-serif fw-bold mb-0 text-dark">Recent Registrations</h5>
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-sm rounded-pill px-4 fw-bold shadow-sm" style="background: #111; color: white;">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table premium-table mb-0 border-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Candidate Profile</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stats['recent_profiles'] as $profile)
                                @php
                                    if($profile['membership_type'] == 'vip'){
                                        $icon = 'bi bi-shield-fill-check';
                                    }elseif($profile['membership_type'] == 'premium'){
                                        $icon = 'bi bi-star-fill';
                                    }elseif($profile['membership_type'] == 'basic'){
                                        $icon = 'bi bi-asterisk';
                                    }else{
                                        $icon = 'bi bi-emoji-smile';
                                    }

                                @endphp
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white bg-gradient-signature" style="width: 45px; height: 45px;"><i class="{{ $icon }}"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark font-sans">{{ $profile->full_name }}</h6>
                                                <small class="text-muted fw-semibold">{{ $profile->occupation }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted"><i class="bi bi-geo-alt-fill text-dark me-2"></i>{{ $profile->district }}, {{ $profile->state }}</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="{{ $profile->approval_status == 'approved' ? 'background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 6px 14px; font-weight: 700;' : 'background: rgba(217, 119, 6, 0.1); color: #d97706; padding: 6px 14px; font-weight: 700;' }}">{{ $profile->approval_status }}</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; color: #111; transition: all 0.3s ease;" onmouseover="this.style.background='#e75480'; this.style.color='white'" onmouseout="this.style.background='#f8f9fa'; this.style.color='#111'">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection