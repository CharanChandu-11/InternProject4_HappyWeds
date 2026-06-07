@extends('layouts.admin')
@section('title', 'Edit Profile - HappilyWeds')

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

    /* Premium Cards */
    .premium-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }

    /* Glowing Premium Buttons */
    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.7rem 1.8rem;
        font-weight: 700;
        transition: all 0.3s ease;
        border: none;
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
        border-radius: 14px;
        padding: 0.6rem 1.5rem;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-premium-outline:hover {
        border-color: #111111;
        color: #111111;
        background: #f8fafc;
        transform: translateY(-2px);
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

<svg class="bg-floating-element" style="top: 45%; left: 35%; width: 80px; --rot-start: 10deg; --rot-mid: 30deg; --duration: 6s;" viewBox="0 0 16 16" fill="url(#signatureGradient)">
    <path d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
</svg>

<div class="container-fluid py-5 page-spacing font-sans">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3 animate-card">
        <div>
            <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.5rem;">Edit Profile Data</h2>
            <p class="text-muted mt-2 mb-0" style="font-size: 1rem; font-weight: 500;">Update candidate information, preferences, and media.</p>
        </div>

        <a href="{{ route('admin.profiles.index') }}" class="btn-premium-outline shadow-sm d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-arrow-left me-2 fs-5"></i> 
            Back to Directory
        </a>
    </div>

    <div class="premium-card animate-card delay-1">
        <div class="card-body p-4 p-lg-5">

            {{-- Error Block --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-5 border-0 shadow-sm animate-card delay-2" style="background: rgba(254, 242, 242, 0.9); backdrop-filter: blur(5px); color: #ef4444; border-radius: 16px; border-left: 4px solid #ef4444;">
                    <h5 class="fw-bold mb-3"><i class="bi bi-exclamation-triangle-fill me-2 fs-5 align-middle"></i> Please fix the following errors:</h5>
                    <ul class="mb-0 fw-medium">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- We are pulling in the beautiful form fields you already styled! --}}
                @include('profiles.form')

                </form>

        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- 1. Source Elements (The User's Data) ---
    const genderEl = document.querySelector('[name="gender"]');
    const dobEl = document.querySelector('[name="dob"]');
    const heightFeetEl = document.querySelector('[name="height_feet"]');
    const heightInchEl = document.querySelector('[name="height_inch"]');
    const maritalStatusEl = document.querySelector('[name="marital_status"]');
    const religionEl = document.querySelector('[name="religion"]');
    const casteEl = document.querySelector('[name="caste"]');

    // --- 2. Target Elements (The Partner Preferences) ---
    const pMinAgeEl = document.querySelector('[name="partner_min_age"]');
    const pMaxAgeEl = document.querySelector('[name="partner_max_age"]');
    const pMinHeightEl = document.querySelector('[name="partner_min_height"]');
    const pMaxHeightEl = document.querySelector('[name="partner_max_height"]');
    const pMaritalStatusSelect = document.querySelector('[name="partner_marital_status[]"]'); 
    const pReligionSelect = document.querySelector('[name="partner_religion[]"]');
    const pCasteSelect = document.querySelector('[name="partner_caste[]"]');

    function autoFillPreferences() {
        const gender = genderEl ? genderEl.value.toLowerCase() : '';
        const dob = dobEl ? dobEl.value : '';
        
        // ====== AGE PREFERENCE (Stored as Birth Years) ======
        if (dob && gender && pMinAgeEl && pMaxAgeEl) {
            const birthYear = new Date(dob).getFullYear();
            
            if (gender === 'male') {
                pMinAgeEl.value = birthYear + 4; 
                pMaxAgeEl.value = birthYear;     
            } else if (gender === 'female') {
                pMinAgeEl.value = birthYear;     
                pMaxAgeEl.value = birthYear - 4; 
            }
        }

        // ====== HEIGHT PREFERENCE ======
        const hFeet = heightFeetEl ? parseInt(heightFeetEl.value) || 0 : 0;
        const hInch = heightInchEl ? parseInt(heightInchEl.value) || 0 : 0;

        if (hFeet > 0 && gender && pMinHeightEl && pMaxHeightEl) {
            const totalInches = (hFeet * 12) + hInch;
            let minTargetInches = 0;
            let maxTargetInches = 0;

            if (gender === 'male') {
                minTargetInches = totalInches - 8;
                maxTargetInches = totalInches - 2;
            } else if (gender === 'female') {
                minTargetInches = totalInches + 2;
                maxTargetInches = totalInches + 8;
            }

            // Convert to CM (1 inch = 2.54 cm)
            pMinHeightEl.value = Math.round(minTargetInches * 2.54);
            pMaxHeightEl.value = Math.round(maxTargetInches * 2.54);
        }

        // ====== MARITAL STATUS PREFERENCE ======
        if (maritalStatusEl && pMaritalStatusSelect) {
            const mStatus = maritalStatusEl.value.toLowerCase();
            
            // Clear existing
            Array.from(pMaritalStatusSelect.options).forEach(opt => opt.selected = false);

            let targetStatuses = [];
            if (mStatus === 'single') {
                targetStatuses = ['single'];
            } else if (['divorced', 'separated', 'widowed', 'awaiting divorce'].includes(mStatus)) {
                targetStatuses = ['divorced', 'separated', 'widowed'];
            }

            Array.from(pMaritalStatusSelect.options).forEach(opt => {
                if (targetStatuses.includes(opt.value.toLowerCase())) {
                    opt.selected = true;
                }
            });
        }

        // ====== RELIGION & CASTE PREFERENCE ======
        if (religionEl && pReligionSelect && religionEl.value) {
            Array.from(pReligionSelect.options).forEach(opt => opt.selected = false);
            Array.from(pReligionSelect.options).forEach(opt => {
                if (opt.value === religionEl.value) opt.selected = true;
            });
        }

        if (casteEl && pCasteSelect && casteEl.value) {
            Array.from(pCasteSelect.options).forEach(opt => opt.selected = false);
            Array.from(pCasteSelect.options).forEach(opt => {
                if (opt.value === casteEl.value) opt.selected = true;
            });
        }
    }

    // --- 3. Attach Listeners ---
    const sourceElements = [genderEl, dobEl, heightFeetEl, heightInchEl, maritalStatusEl, religionEl, casteEl];
    
    sourceElements.forEach(el => {
        if (el) {
            el.addEventListener('change', autoFillPreferences);
        }
    });
});
</script>
@endpush