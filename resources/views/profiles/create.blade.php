@extends('layouts.admin')

@section('title', 'Create New Profile | HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }
    
    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        display: inline-block;
    }

    /* --- FIX 1: SPACING FROM SIDEBAR AND TOP --- */
    .admin-content-spacing {
        padding: 40px 50px; /* This creates the gap from the sidebar! */
        max-width: 1600px;
        margin: 0 auto;
        min-height: 100vh;
    }

    /* --- FIX 2: THE WHITE FORM CONTAINER --- */
    .form-white-card {
        background: #ffffff;
        border-radius: 24px;
        padding: 50px 60px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04);
        border: 1px solid #f1f5f9;
    }

    /* --- FIX 3: OVERRIDE FORM SECTION HEADERS --- */
    /* Since the main box is now white, we give the section headers a soft gray tint so they stand out */
    .section-header-card {
        background: #f8fafc !important; 
        border: 1px solid #e2e8f0 !important;
        box-shadow: none !important;
        border-radius: 16px !important;
    }

    /* Alerts */
    .premium-alert {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-left: 5px solid #ef4444;
        color: #991b1b;
        border-radius: 16px;
        padding: 20px 25px;
        margin-bottom: 30px;
    }

    /* Back Button */
    .btn-action-outline {
        background: #ffffff;
        color: #475569;
        border: 2px solid #e2e8f0;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .btn-action-outline:hover {
        background: #f8fafc;
        border-color: #111111;
        color: #111111;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .admin-content-spacing { padding: 20px; }
        .form-white-card { padding: 30px 20px; border-radius: 20px; }
    }
</style>
@endpush

@section('content')
<div class="admin-content-spacing font-sans">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-2">
        <h2 class="font-serif fw-bold m-0 text-gradient" style="font-size: 2.8rem; letter-spacing: -1px;">
            Create New Profile
        </h2>
        <a href="{{ route('admin.profiles.index') }}" class="btn-action-outline shadow-sm">
            <i class="bi bi-arrow-left me-2"></i> Back to Directory
        </a>
    </div>

    <div class="form-white-card">
        
        @if ($errors->any())
            <div class="premium-alert">
                <h5 class="fw-bold mb-3 text-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the following errors:
                </h5>
                <ul class="mb-0 fw-medium">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @include('profiles.form')

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