@extends('layouts.admin')

@section('title', 'Profiles List - HappilyWeds')

@push('page-styles')
<style>
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }

    .premium-input, 
    select.form-select.premium-input {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        padding: 0.7rem 1.2rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.95rem;
        font-weight: 500;
        color: #334155;
        background-color: #ffffff;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0,0,0,0.01);
        cursor: pointer;
    }

    select.form-select.premium-input {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23e75480' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-size: 16px 12px;
    }

    .premium-input:focus, 
    select.form-select.premium-input:focus {
        border-color: #e75480;
        background-color: #ffffff;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
        outline: none;
    }

    .premium-input[readonly] {
        background-color: #f8fafc;
        cursor: not-allowed;
    }

    .premium-label {
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #64748b;
        margin-bottom: 0.5rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .section-header-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: transform 0.3s ease;
    }
    
    .section-header-card:hover {
        transform: translateX(8px);
        border-color: rgba(231, 84, 128, 0.2);
    }

    .icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 15px rgba(231, 84, 128, 0.25);
    }

    .btn-glow {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(231, 84, 128, 0.3);
        border-radius: 14px;
        padding: 0.8rem 2rem;
        font-weight: 700;
        font-size: 1.1rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-glow:hover {
        color: #ffffff;
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(231, 84, 128, 0.45);
    }

    /* ── SELECT2 OVERRIDES ── */
    .select2-container--default .select2-selection--single,
    .select2-container--default .select2-selection--multiple {
        border-radius: 12px;
        border: 2px solid #f1f5f9;
        min-height: 46px;
        padding: 4px 8px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default.select2-container--focus .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--single,
    .select2-container--default.select2-container--open .select2-selection--multiple {
        border-color: #e75480;
        box-shadow: 0 0 0 5px rgba(231, 84, 128, 0.1);
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 34px;
        color: #334155;
        font-weight: 500;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 44px;
        right: 10px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #fff0f5;
        border: 1px solid #fbcfe8;
        color: #e75480;
        border-radius: 8px;
        padding: 4px 10px;
        font-weight: 600;
        margin-top: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: #e75480;
        border-right: none;
        margin-right: 5px;
        transition: color 0.2s;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
        background: transparent;
        color: #be185d;
    }

    .select2-dropdown {
        border: 2px solid #e2e8f0;
        border-radius: 16px !important;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        font-family: 'Plus Jakarta Sans', sans-serif;
        overflow: hidden;
        margin-top: 5px;
        z-index: 9999;
    }

    .select2-search--dropdown .select2-search__field {
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        padding: 8px 12px;
    }

    .select2-search--dropdown .select2-search__field:focus {
        border-color: #e75480;
        outline: none;
        box-shadow: 0 0 0 3px rgba(231, 84, 128, 0.1);
    }

    .select2-results__option {
        padding: 10px 16px;
        color: #475569;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected],
    .select2-container--default .select2-results__option--highlighted[aria-selected]:hover {
        background-color: #e75480 !important;
        color: white !important;
        font-weight: 600;
    }

    .select2-container--default .select2-results__option[aria-selected="true"] {
        background-color: #f8fafc;
        color: #e75480;
        position: relative;
    }

    .select2-container--default .select2-results__option[aria-selected="true"]::after {
        content: '✓';
        position: absolute;
        right: 16px;
    }

    /* ── CUSTOM TAG PILLS ── */
    .ui-tag {
        background: #fff0f5;
        border: 1px solid #fbcfe8;
        color: #be185d;
        border-radius: 8px;
        padding: 5px 10px 5px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        animation: popIn 0.2s ease-out;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .ui-tag-close {
        background: #fbcfe8;
        border: none;
        color: #be185d;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        padding: 0;
        line-height: 1;
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s, transform 0.2s;
        flex-shrink: 0;
    }

    .ui-tag-close:hover {
        background: #e75480;
        color: #fff;
        transform: scale(1.15);
    }

    @keyframes popIn {
        from { transform: scale(0.85); opacity: 0; }
        to   { transform: scale(1);    opacity: 1; }
    }

    /* Picker wrapper — makes the select look like a search input */
    .tag-picker-wrapper {
        position: relative;
    }

    .tag-picker-wrapper .select2-container {
        width: 100% !important;
    }

    /* Tags display area */
    .tags-display-area {
        min-height: 36px;
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .tags-display-area:empty::before {
        content: 'No selections yet';
        color: #cbd5e1;
        font-size: 0.8rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        align-self: center;
    }

    .dropzone {
        border: 2px dashed #cbd5e1 !important;
        border-radius: 16px !important;
        background: #f8fafc !important;
        transition: all 0.3s ease;
        min-height: 150px;
    }

    .dropzone:hover {
        border-color: #e75480 !important;
        background: #fff0f5 !important;
    }

    /* Smooth conditional field transitions */
    .conditional-marital {
        transition: opacity 0.3s ease;
    }
    .w-60{
        width: 60px !important;
    }
</style>
@endpush

@section('content')

<form action="{{ isset($profile) ? route('admin.profiles.update', $profile->id) : route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($profile))
        @method('PUT')
    @endif

    @if ($errors->any())
        <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; width: 350px;">
            <div class="alert alert-danger alert-dismissible fade show shadow">
                
                <strong class="d-block mb-2">
                    <i class="fa fa-exclamation-circle"></i> Please fix the following errors:
                </strong>

                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <div class="row g-4 font-sans pb-5">

        {{-- ================= PERSONAL INFORMATION ================= --}}
        <div class="col-12 mt-2 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-person-vcard-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Personal Information</h4>
            </div>
        </div>

        <div class="col-md-1 me-0 pe-0">
            <label class="premium-label">Title</label>
            <select name="title" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['Mr','Ms'] as $t)
                    <option value="{{ $t }}" {{ old('title', $profile->title ?? '') == $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 ms-0 ps-0">
            <label class="premium-label">First Name *</label>
            <input type="text" name="first_name" class="form-control premium-input" value="{{ old('first_name', $profile->first_name ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Last Name</label>
            <input type="text" name="last_name" class="form-control premium-input" value="{{ old('last_name', $profile->last_name ?? '') }}">
        </div>

        <div class="col-md-2 me-0 pe-0">
            <label class="premium-label">Country Code *</label>
            <select name="country_code" class="form-select premium-input select2" required>
                <option value="">Select</option>
                @foreach($CountryCode->unique('dial_code')->sortBy('dial_code') as $code)
                    <option value="{{ $code['dial_code'] }}" {{ old('country_code', $profile->country_code ?? '+91') == $code['dial_code'] ? 'selected' : '' }}>
                        {{ $code['dial_code'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 ms-0 ps-0">
            <label class="premium-label">Mobile</label>
            <input type="text" name="mobile" class="form-control premium-input" value="{{ old('mobile', $profile->mobile ?? '') }}">
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Alternate Mobile</label>
            <input type="text" name="alternate_mobile" class="form-control premium-input" value="{{ old('alternate_mobile', $profile->alternate_mobile ?? '') }}">
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Email</label>
            <input type="email" name="email" class="form-control premium-input" value="{{ old('email', $profile->email ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Gender *</label>
            <select name="gender" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['male','female','other'] as $g)
                    <option value="{{ $g }}" {{ old('gender', $profile->gender ?? '') == $g ? 'selected' : '' }}>{{ mb_convert_case($g, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Referenced By</label>
            <select name="registered_by" class="form-select premium-input">
                <option value="">Select</option>
                @foreach($references as $pcb)
                    <option value="{{ $pcb->id }}" {{ old('registered_by', $profile->registered_by ?? '') == $pcb->id ? 'selected' : '' }}>
                        {{ mb_convert_case(str_replace('_', ' ', $pcb->name), MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Subscription Plan</label>
            <select name="membership_type" class="form-select premium-input">
                <option value="">Select</option>
                @foreach($subscriptionPlans as $plan)
                    <option value="{{ $plan['name'] }}" {{ old('membership_type', $profile->membership_type ?? 'free') == $plan['name'] ? 'selected' : '' }}>
                        {{ $plan['name'] }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- ================= BIRTH & PHYSICAL ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-calendar2-heart-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Birth & Physical Details</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control premium-input"
                value="{{ old('dob', isset($profile) && $profile->dob ? \Carbon\Carbon::parse($profile->dob)->format('Y-m-d') : '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Time of Birth</label>
            <input type="time" name="tob" class="form-control premium-input"
                value="{{ old('tob', isset($profile) && $profile->tob ? \Carbon\Carbon::parse($profile->tob)->format('H:i') : '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Place of Birth</label>
            <select name="birth_place" id="birth_place" class="form-select premium-input select2">
                <option value="">Select District</option>
                @foreach($Area->unique('area')->sortBy('area') as $code)
                    <option value="{{ $code['area'] }}" data-state="{{ $code['state'] }}"
                        {{ old('birth_place', $profile->birth_place ?? '') == $code['area'] ? 'selected' : '' }}>
                        {{ $code['area'] }}
                    </option>
                @endforeach
            </select>
        </div>

        @php
            // Pre-calculate ft/in from stored CM for edit mode
            $heightFeet = '';
            $heightInch = '';

            if (!empty($profile->height_cm)) {
                $totalInches = round($profile->height_cm / 2.54);

                $heightFeet = intdiv($totalInches, 12);
                $heightInch = $totalInches % 12;
            }
        @endphp

        <div class="col-md-3">
            <label class="premium-label">Height (Ft / In)</label>

            <div class="d-flex gap-2">

                <select name="height_feet" id="height_feet" class="form-select premium-input">
                    <option value="">Feet</option>

                    @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}"
                            {{ old('height_feet', $heightFeet) == $i ? 'selected' : '' }}>
                            {{ $i }} ft
                        </option>
                    @endfor
                </select>

                <select name="height_inch" id="height_inch" class="form-select premium-input">
                    <option value="">Inch</option>

                    @for($i = 0; $i <= 11; $i++)
                        <option value="{{ $i }}"
                            {{ old('height_inch', $heightInch) == $i ? 'selected' : '' }}>
                            {{ $i }} in
                        </option>
                    @endfor
                </select>

            </div>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Height (CM)</label>
            <input type="number" name="height_cm" id="height_cm" class="form-control premium-input"
                value="{{ old('height_cm', $profile->height_cm ?? '') }}"
                placeholder="Enter CM or pick Ft / In above">
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Weight (kg)</label>
            <input type="number" step="0.1" name="weight_kg" class="form-control premium-input" value="{{ old('weight_kg', $profile->weight_kg ?? '') }}">
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Blood Group</label>
            <select name="blood_group" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $bg)
                    <option value="{{ $bg }}" {{ old('blood_group', $profile->blood_group ?? '') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Complexion</label>
            <select name="complexion" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['very_fair','fair','wheatish','dark'] as $c)
                    <option value="{{ $c }}" {{ old('complexion', $profile->complexion ?? '') == $c ? 'selected' : '' }}>{{ mb_convert_case($c, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Body Type</label>
            <select name="body_type" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['slim','average','athletic','heavy'] as $bt)
                    <option value="{{ $bt }}" {{ old('body_type', $profile->body_type ?? '') == $bt ? 'selected' : '' }}>{{ mb_convert_case($bt, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Physical Status</label>
            <select name="physical_status" class="form-select premium-input">
                @foreach(['normal','physically_challenged'] as $ps)
                    <option value="{{ $ps }}" {{ old('physical_status', $profile->physical_status ?? 'normal') == $ps ? 'selected' : '' }}>
                        {{ mb_convert_case(str_replace('_', ' ', $ps), MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>


        {{-- ================= MARITAL STATUS ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-rings fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Marital Status</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Marital Status *</label>
            <select name="marital_status" id="marital_status" class="form-select premium-input" required>
                <option value="">Select</option>
                @foreach(['single','separated','divorced','widowed','awaiting_divorce','married'] as $status)
                    <option value="{{ $status }}"
                        {{ old('marital_status', $profile->marital_status ?? 'single') == $status ? 'selected' : '' }}>
                        {{ mb_convert_case(str_replace('_', ' ', $status), MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- These three are hidden when status = single --}}
        <div class="col-md-3 conditional-marital" style="display:none;">
            <label class="premium-label">Children (if any)</label>
            <input type="number" name="children" min="0" class="form-control premium-input"
                value="{{ old('children', $profile->children ?? '') }}">
        </div>

        <div class="col-md-3 conditional-marital" style="display:none;">
            <label class="premium-label">Children Living With</label>
            <select name="children_living_with" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['self','partner','joint'] as $clw)
                    <option value="{{ $clw }}" {{ old('children_living_with', $profile->children_living_with ?? '') == $clw ? 'selected' : '' }}>
                        {{ mb_convert_case($clw, MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 conditional-marital" style="display:none;">
            <label class="premium-label">Divorce / Separation Details</label>
            <textarea name="divorce_details" class="form-control premium-input" rows="1" style="min-height:46px;">{{ old('divorce_details', $profile->divorce_details ?? '') }}</textarea>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Widow/Widower Details</label>
            <textarea name="widow_widower_details" class="form-control premium-input" rows="1" style="min-height:46px;">{{ old('widow_widower_details', $profile->widow_widower_details ?? '') }}</textarea>
        </div>


        {{-- ================= PERSONAL & HOROSCOPE ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-moon-stars-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Personal & Horoscope</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mangal Dosh</label>
            <select name="mangal_dosh" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['yes','no','anshik', 'not_sure'] as $dosh)
                    <option value="{{ $dosh }}" {{ old('mangal_dosh', $profile->mangal_dosh ?? '') == $dosh ? 'selected' : '' }}>{{ mb_convert_case($dosh, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Gotra</label>
            <select name="gotra" class="form-select premium-input select2">
                <option value="">Select</option>
                @foreach($Gotra->sortBy('gotra') as $gotra)
                    <option value="{{ $gotra->gotra }}" {{ old('gotra', $profile->gotra ?? '') == $gotra->gotra ? 'selected' : '' }}>{{ $gotra->gotra }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Diet</label>
            <select name="diet" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['vegetarian','non_vegetarian','eggetarian','vegan','jain'] as $diet)
                    <option value="{{ $diet }}" {{ old('diet', $profile->diet ?? 'vegetarian') == $diet ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $diet), MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Drinking Habits</label>
            <select name="drinking_habits" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['never','occasionally','regularly'] as $val)
                    <option value="{{ $val }}" {{ old('drinking_habits', $profile->drinking_habits ?? '') == $val ? 'selected' : '' }}>{{ mb_convert_case($val, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>


        {{-- ================= EDUCATION & PROFESSION ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-mortarboard-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Education & Profession</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Highest Qualification</label>
            <select name="highest_qualification" class="form-select premium-input select2">
                <option value="">Select</option>
                @foreach($Education->sortBy('education') as $code)
                    <option value="{{ $code['education'] }}" {{ old('highest_qualification', $profile->highest_qualification ?? '') == $code['education'] ? 'selected' : '' }}>{{ $code['education'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Occupation</label>
            <select name="occupation" class="form-select premium-input select2">
                <option value="">Select</option>
                @foreach($Occupation->sortBy('occupation') as $code)
                    <option value="{{ $code['occupation'] }}" {{ old('occupation', $profile->occupation ?? '') == $code['occupation'] ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Designation</label>
            <input type="text" name="designation" class="form-control premium-input" value="{{ old('designation', $profile->designation ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Company Name</label>
            <input type="text" name="company_name" class="form-control premium-input" value="{{ old('company_name', $profile->company_name ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Industry</label>
            <input type="text" name="industry" class="form-control premium-input" value="{{ old('industry', $profile->industry ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Job Type</label>
            <select name="job_type" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['government','private','business','not_working','student'] as $jt)
                    <option value="{{ $jt }}" {{ old('job_type', $profile->job_type ?? '') == $jt ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $jt), MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        

        <div class="col-md-3">
            <label class="premium-label">Self Income</label>
            <input type="number" step="any" name="self_income" class="form-control premium-input" value="{{ old('self_income', $profile->self_income ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Family Income</label>
            <input type="number" step="any" name="family_income" class="form-control premium-input" value="{{ old('family_income', $profile->family_income ?? '') }}">
        </div>


        {{-- ================= RELIGION & COMMUNITY ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-bank2 fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Religion & Community</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Religion</label>
            <select name="religion" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['Hinduism','Islam','Christianity','Sikhism','Buddhism','Jainism','Others'] as $religion)
                    <option value="{{ $religion }}" {{ old('religion', $profile->religion ?? 'Hinduism') == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Caste</label>
            <select name="caste" class="form-select premium-input select2">
                <option value="">Select</option>
                @foreach($Caste->sortBy('caste') as $code)
                    <option value="{{ $code['caste'] }}" {{ old('caste', $profile->caste ?? 'Bania') == $code['caste'] ? 'selected' : '' }}>{{ $code['caste'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Languages Known</label>
            <select name="languages_known[]" class="form-select premium-input select2" multiple>
                @php $selectedLangs = old('languages_known', $profile->languages_known ?? []); @endphp
                @foreach(['Hindi','English','Gujarati','Marathi','Tamil','Telugu','Kannada','Malayalam','Bengali','Punjabi','Urdu','Others'] as $lang)
                    <option value="{{ $lang }}" {{ in_array($lang, $selectedLangs) ? 'selected' : '' }}>{{ $lang }}</option>
                @endforeach
            </select>
        </div>


        {{-- ================= FAMILY BACKGROUND ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-house-heart-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Family Background</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Father First Name</label>
            <input type="text" name="father_first" class="form-control premium-input" value="{{ old('father_first', $profile->father_first ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Father Last Name</label>
            <input type="text" name="father_last" class="form-control premium-input" value="{{ old('father_last', $profile->father_last ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Father Occupation</label>
            <select name="father_occupation" class="form-select premium-input select2">
                <option value="">Select</option>
                @foreach($Occupation->sortBy('occupation') as $code)
                    <option value="{{ $code['occupation'] }}" {{ old('father_occupation', $profile->father_occupation ?? 'Businessman') == $code['occupation'] ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Father Alive?</label>
            <select name="father_alive" class="form-select premium-input">
                <option value="1" {{ old('father_alive', $profile->father_alive ?? '1') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('father_alive', $profile->father_alive ?? '') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mother First Name</label>
            <input type="text" name="mother_first" class="form-control premium-input" value="{{ old('mother_first', $profile->mother_first ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mother Last Name</label>
            <input type="text" name="mother_last" class="form-control premium-input" value="{{ old('mother_last', $profile->mother_last ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mother Occupation</label>
            <select name="mother_occupation" class="form-select premium-input select2">
                <option value="">Select</option>
                @php $motherOccDefault = old('mother_occupation', $profile->mother_occupation ?? 'Homemaker'); @endphp
                <option value="Homemaker" {{ $motherOccDefault == 'Homemaker' ? 'selected' : '' }}>Homemaker</option>
                <option value="Housewife"  {{ $motherOccDefault == 'Housewife'  ? 'selected' : '' }}>Housewife</option>
                @foreach($Occupation->sortBy('occupation') as $code)
                    @if(!in_array($code['occupation'], ['Homemaker','Housewife']))
                        <option value="{{ $code['occupation'] }}" {{ $motherOccDefault == $code['occupation'] ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mother Alive?</label>
            <select name="mother_alive" class="form-select premium-input">
                <option value="1" {{ old('mother_alive', $profile->mother_alive ?? '1') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('mother_alive', $profile->mother_alive ?? '') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">No. of Brothers</label>
            <input type="number" name="no_of_brothers" min="0" class="form-control premium-input" value="{{ old('no_of_brothers', $profile->no_of_brothers ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">No. of Sisters</label>
            <input type="number" name="no_of_sisters" min="0" class="form-control premium-input" value="{{ old('no_of_sisters', $profile->no_of_sisters ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Married Brothers</label>
            <input type="number" name="married_brothers" min="0" class="form-control premium-input" value="{{ old('married_brothers', $profile->married_brothers ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Married Sisters</label>
            <input type="number" name="married_sisters" min="0" class="form-control premium-input" value="{{ old('married_sisters', $profile->married_sisters ?? '') }}">
        </div>


        {{-- ================= ADDRESS ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-geo-alt-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Address Details</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">House No</label>
            <input type="text" name="house_no" class="form-control premium-input" value="{{ old('house_no', $profile->house_no ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Colony / Road</label>
            <input type="text" name="colony" class="form-control premium-input" value="{{ old('colony', $profile->colony ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Street</label>
            <input type="text" name="street" class="form-control premium-input" value="{{ old('street', $profile->street ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Pincode</label>
            <input type="text" name="pincode" class="form-control premium-input" value="{{ old('pincode', $profile->pincode ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">City</label>
            <select name="city" id="city" class="form-select premium-input select2">
                <option value="">Select City</option>
                @foreach($Area->unique('area')->sortBy('area') as $code)
                    <option value="{{ $code['area'] }}" data-state="{{ $code['state'] }}" data-district="{{ $code['district'] }}" data-country="{{ $code['country'] }}"
                        {{ old('city', $profile->city ?? '') == $code['area'] ? 'selected' : '' }}>
                        {{ $code['area'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">District</label>
            <select name="district" id="district" class="form-select premium-input select2">
                <option value="">Select District</option>
                @foreach($Area->unique('district')->sortBy('district') as $code)
                    <option value="{{ $code['district'] }}" data-state="{{ $code['state'] }}" data-country="{{ $code['country'] }}"
                        {{ old('district', $profile->district ?? '') == $code['district'] ? 'selected' : '' }}>
                        {{ $code['district'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">State</label>
            <select name="state" id="state" class="form-select premium-input select2">
                <option value="">Select State</option>
                @foreach($Area->unique('state')->sortBy('state') as $code)
                    <option value="{{ $code['state'] }}" data-country="{{ $code['country'] }}" {{ old('state', $profile->state ?? '') == $code['state'] ? 'selected' : '' }}>{{ $code['state'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Country *</label>
            <select name="country" class="form-select premium-input select2" id="country" required>
                <option value="">Select</option>
                @foreach($Area->unique('country')->sortBy('country') as $code)
                    <option value="{{ $code['country'] }}" {{ old('country', $profile->country ?? 'India') == $code['country'] ? 'selected' : '' }}>{{ $code['country'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6">
            <label class="premium-label">Current Address</label>
            <textarea name="current_address" class="form-control premium-input" rows="2">{{ old('current_address', $profile->current_address ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label class="premium-label">Permanent Address</label>
            <textarea name="permanent_address" class="form-control premium-input" rows="2">{{ old('permanent_address', $profile->permanent_address ?? '') }}</textarea>
        </div>


        {{-- ================= PARTNER PREFERENCES ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-hearts fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Partner Preferences</h4>
            </div>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Caste Barrier</label>
            <select name="caste_barrier" class="form-select premium-input">
                <option value="1" {{ old('caste_barrier', $profile->caste_barrier ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('caste_barrier', $profile->caste_barrier ?? '') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Min Age</label>
            <input type="number" name="partner_min_age" class="form-control yearPicker premium-input" min="{{ date('Y')-71 }}" max="{{ date('Y') }}" value="{{ old('partner_min_age', $profile->partner_min_age ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Max Age</label>
            <input type="number" name="partner_max_age" class="form-control yearPicker premium-input" min="{{ date('Y')-71 }}" max="{{ date('Y') }}" value="{{ old('partner_max_age', $profile->partner_max_age ?? '') }}">
        </div>
        <div id="yearGrid" style="width:auto; display:none; position:absolute; background:#fff; border:1px solid #ddd; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding:10px; display: grid; grid-template-columns: repeat(4, 1fr); gap: 5px; z-index: 1000; max-height: 200px; overflow-y: auto;"></div>
        <script>
            const inputs = document.querySelectorAll('.yearPicker');
            const grid = document.getElementById('yearGrid');
            
            // Dynamic year range based on your requirements
            const currentYear = new Date().getFullYear();
            const startYear = currentYear - 71;
            const endYear = currentYear;

            let activeInput = null;

            // Populate the grid once
            for (let y = endYear; y >= startYear; y--) {
                let btn = document.createElement('button');
                btn.type = "button"; // Prevent form submission
                btn.innerText = y;
                btn.className = "btn btn-sm btn-outline-secondary w-60";
                btn.onclick = (e) => {
                    if (activeInput) {
                        activeInput.value = y;
                        grid.style.display = 'none';
                    }
                };
                grid.appendChild(btn);
            }

            // Attach logic to all elements with class .yearPicker
            inputs.forEach(input => {
                input.addEventListener('click', function(e) {
                    activeInput = this;
                    
                    // Position the grid under the clicked input
                    grid.style.display = 'grid';
                    grid.style.left = this.offsetLeft + "px";
                    grid.style.top = (this.offsetTop + this.offsetHeight) + "px";
                    
                    e.stopPropagation();
                });
            });

            // Close grid if clicked anywhere else
            document.addEventListener('click', (e) => {
                if (!grid.contains(e.target)) {
                    grid.style.display = 'none';
                }
            });
        </script>

        @php
            // Pre-calculate ft/in from stored CM for edit mode

            $minheightFeet = '';
            $minheightInch = '';

            $maxheightFeet = '';
            $maxheightInch = '';

            // MIN HEIGHT
            if (!empty($profile->partner_min_height)) {

                $mintotalInches = round($profile->partner_min_height / 2.54);

                $minheightFeet = intdiv($mintotalInches, 12);
                $minheightInch = $mintotalInches % 12;
            }

            // MAX HEIGHT
            if (!empty($profile->partner_max_height)) {

                $maxtotalInches = round($profile->partner_max_height / 2.54);

                $maxheightFeet = intdiv($maxtotalInches, 12);
                $maxheightInch = $maxtotalInches % 12;
            }
        @endphp

        <div class="col-md-3">
            <label class="premium-label">Min Height (Ft / In)</label>

            <div class="d-flex gap-0">

                <select name="partner_min_height_feet"
                        id="partner_min_height_feet"
                        class="form-select premium-input">

                    <option value="">Feet</option>

                    @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}"
                            {{ old('partner_min_height_feet', $minheightFeet) == $i ? 'selected' : '' }}>
                            {{ $i }} ft
                        </option>
                    @endfor

                </select>

                <select name="partner_min_height_inch"
                        id="partner_min_height_inch"
                        class="form-select premium-input">

                    <option value="">Inch</option>

                    @for($i = 0; $i <= 11; $i++)
                        <option value="{{ $i }}"
                            {{ old('partner_min_height_inch', $minheightInch) == $i ? 'selected' : '' }}>
                            {{ $i }} in
                        </option>
                    @endfor

                </select>

            </div>
        </div>


        <div class="col-md-3 d-none">
            <label class="premium-label">Min Height (CM)</label>

            <input type="number"
                name="partner_min_height"
                id="partner_min_height"
                class="form-control premium-input"
                value="{{ old('partner_min_height', $profile->partner_min_height ?? '') }}">
        </div>


        <div class="col-md-3">
            <label class="premium-label">Max Height (Ft / In)</label>

            <div class="d-flex gap-0">

                <select name="partner_max_height_feet"
                        id="partner_max_height_feet"
                        class="form-select premium-input">

                    <option value="">Feet</option>

                    @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}"
                            {{ old('partner_max_height_feet', $maxheightFeet) == $i ? 'selected' : '' }}>
                            {{ $i }} ft
                        </option>
                    @endfor

                </select>

                <select name="partner_max_height_inch"
                        id="partner_max_height_inch"
                        class="form-select premium-input">

                    <option value="">Inch</option>

                    @for($i = 0; $i <= 11; $i++)
                        <option value="{{ $i }}"
                            {{ old('partner_max_height_inch', $maxheightInch) == $i ? 'selected' : '' }}>
                            {{ $i }} in
                        </option>
                    @endfor

                </select>

            </div>
        </div>


        <div class="col-md-3 d-none">
            <label class="premium-label">Max Height (CM)</label>

            <input type="number"
                name="partner_max_height"
                id="partner_max_height"
                class="form-control premium-input"
                value="{{ old('partner_max_height', $profile->partner_max_height ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Religion</label>
            <select name="partner_religion[]" class="form-select select2 premium-input" multiple>
                <option value="">Select</option>
                @foreach(['Hinduism','Islam','Christianity','Sikhism','Buddhism','Jainism','Others'] as $religion)
                    <option value="{{ $religion }}" {{ old('partner_religion', $profile->partner_religion ?? []) == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                @endforeach
            </select>
        </div>

        {{-- ── CASTE PREFERENCES (multi-tag) ── --}}
        <div class="col-md-3">
            <label class="premium-label">Caste Preferences</label>

            @php
                $rawCaste              = isset($profile) ? $profile->partner_caste : '';
                $selectedPartnerCastes = is_string($rawCaste) ? json_decode($rawCaste, true) : $rawCaste;
                if (!is_array($selectedPartnerCastes)) {
                    $selectedPartnerCastes = $rawCaste ? array_map('trim', explode(',', $rawCaste)) : [];
                }
                $oldPartnerCastes = old('partner_caste', $selectedPartnerCastes);
            @endphp

            <select id="caste_picker" name="partner_caste[]" class="form-select premium-input select2" multiple data-placeholder="Select castes">
                @foreach($Caste->sortBy('caste') as $code)
                    <option value="{{ $code['caste'] }}" {{ in_array($code['caste'], $oldPartnerCastes) ? 'selected' : '' }}>{{ $code['caste'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Occupation</label>
            <select name="partner_occupation[]" class="form-select premium-input select2" multiple>
                @foreach($Occupation->sortBy('occupation') as $code)
                    <option value="{{ $code['occupation'] }}" {{ in_array($code['occupation'], old('partner_occupation', $profile->partner_occupation ?? [])) ? 'selected' : '' }}>{{ $code['occupation'] }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Min Income Priority</label>
            <input type="number" step="any" name="partner_income" class="premium-input form-control" value="{{ old('partner_income', $profile->partner_income ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Max Income Priority</label>
            <input type="number" step="any" name="partner_budget_demand" class="premium-input form-control" value="{{ old('partner_budget_demand', $profile->partner_budget_demand ?? '') }}">
        </div>

        <div class="col-md-3">
            <label class="premium-label">Marital Status</label>
            <select name="partner_marital_status[]" class="form-select premium-input select2" multiple>
                @foreach(['single','separated','divorced','widowed','awaiting_divorce'] as $status)
                    <option value="{{ $status }}" {{ in_array($status, old('partner_marital_status', $profile->partner_marital_status ?? [])) ? 'selected' : '' }}>
                        {{ mb_convert_case(str_replace('_', ' ', $status), MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Mangal Dosh</label>
            <select name="partner_mangal_dosh[]" class="form-select premium-input select2" multiple>
                <option value="">Select</option>
                @foreach(['yes','no','anshik', 'not_sure'] as $dosh)
                    <option value="{{ $dosh }}" {{ in_array($dosh, old('partner_mangal_dosh', $profile->partner_mangal_dosh ?? [])) ? 'selected' : '' }}>{{ mb_convert_case($dosh, MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Diet</label>
            <select name="partner_diet[]" class="form-select premium-input select2" multiple>
                <option value="">Select</option>
                @foreach(['vegetarian','non_vegetarian','eggetarian','vegan','jain'] as $diet)
                    <option value="{{ $diet }}" {{ in_array($diet, old('partner_diet', $profile->partner_diet ?? [])) ? 'selected' : '' }}>{{ mb_convert_case(str_replace('_', ' ', $diet), MB_CASE_TITLE, 'UTF-8') }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="premium-label">Physical Status</label>
            <select name="partner_physical_status" class="form-select premium-input">
                <option value="">Select</option>
                @foreach(['normal','physically_challenged'] as $ps)
                    <option value="{{ $ps }}" {{ old('partner_physical_status', $profile->partner_physical_status ?? 'normal') == $ps ? 'selected' : '' }}>
                        {{ mb_convert_case(str_replace('_', ' ', $ps), MB_CASE_TITLE, 'UTF-8') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 d-none">
            <label class="premium-label">Horoscope Required?</label>
            <select name="horoscope" class="form-select premium-input">
                <option value="1" {{ old('horoscope', $profile->horoscope ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ old('horoscope', $profile->horoscope ?? '') == '0' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        {{-- ── AREA PREFERENCE (multi-tag) ── --}}
        <div class="col-md-6">
            <label class="premium-label">Area Preference</label>

            <select id="area_picker" class="form-select premium-input">
                <option value="">Select state / area to add…</option>
                @foreach($Area->unique('state')->sortBy('state') as $code)
                    <option value="{{ $code['state'] }}">{{ $code['state'] }}</option>
                @endforeach
            </select>

            {{-- Visual tag pills --}}
            <div id="area_tags_display" class="tags-display-area"></div>

            {{-- Hidden inputs submitted to Laravel --}}
            <div id="area_hidden_form_data">
                @php
                    $rawArea       = isset($profile) ? $profile->area_preference : '';
                    $selectedAreas = is_string($rawArea) ? json_decode($rawArea, true) : $rawArea;
                    if (!is_array($selectedAreas)) {
                        $selectedAreas = $rawArea ? array_map('trim', explode(',', $rawArea)) : [];
                    }
                    $oldAreas = old('area_preference', $selectedAreas);
                @endphp
                @foreach($oldAreas as $area)
                    <input type="hidden" name="area_preference[]" value="{{ $area }}">
                @endforeach
            </div>
        </div>


        {{-- ================= MEDIA ================= --}}
        <div class="col-12 mt-5 mb-2">
            <div class="d-flex align-items-center p-3 section-header-card">
                <div class="icon-wrapper me-3">
                    <i class="bi bi-camera-fill fs-5 text-white"></i>
                </div>
                <h4 class="font-serif fw-bold mb-0 text-dark">Media Uploads</h4>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="premium-label">Profile Photo</label>
            <input type="file" name="profile_photo" class="form-control premium-input" accept="image/*">
            @if(isset($profile) && $profile->profile_photo)
                <a class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm" href="{{ asset('public/storage/'.$profile->profile_photo) }}" target="_blank">
                    <img src="{{ asset('public/storage/'.$profile->profile_photo) }}" width="120" class="rounded-3" style="object-fit:cover;">
                </a>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <label class="premium-label">Horoscope Image</label>
            <input type="file" name="horoscope_image" class="form-control premium-input" accept="image/*">
            @if(isset($profile) && $profile->horoscope_image)
                <a class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm" href="{{ asset('public/storage/'.$profile->horoscope_image) }}" target="_blank">
                    <img src="{{ asset('public/storage/'.$profile->horoscope_image) }}" width="120" class="rounded-3" style="object-fit:cover;">
                </a>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <label class="premium-label">Family Images (multiple)</label>
            <input type="file" name="family_images[]" class="form-control premium-input" accept="image/*" multiple>
            @if(isset($profile) && $profile->family_images)
                <div class="mt-3 p-2 border rounded-4 bg-white d-flex flex-wrap gap-2 shadow-sm">
                    @foreach($profile->family_images as $img)
                        <a href="{{ asset('public/storage/'.$img) }}" target="_blank" class="d-block border rounded-3" title="View Full Image">
                            <img src="{{ asset('public/storage/'.$img) }}" width="80" height="80" class="rounded-3" style="object-fit:cover;">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <label class="premium-label">Video Profile</label>
            <input type="file" name="video_profile" class="form-control premium-input" accept="video/*">
            @if(isset($profile) && $profile->video_profile)
                <a class="mt-3 p-2 border rounded-4 bg-white d-inline-block shadow-sm" href="{{ asset('public/storage/'.$profile->video_profile) }}" target="_blank">
                    <video width="200" class="rounded-3" controls >
                        <source src="{{ asset('public/storage/'.$profile->video_profile) }}">
                    </video>
                </a>
            @endif
        </div>

        <div class="col-md-12 mb-5">
            <label class="premium-label">Self Images Gallery (Max 10)</label>
            <div id="myDropzone" class="dropzone shadow-sm d-flex flex-column justify-content-center align-items-center text-muted">
                <i class="bi bi-cloud-upload-fill fs-1 mb-2" style="color:#e75480;"></i>
                <h6 class="font-sans fw-bold">Drag &amp; Drop images here</h6>
                <small>or click to browse</small>
            </div>
            <div id="uploadedImages"></div>
            @if(isset($profile) && $profile->self_images)
                <div class="mt-4 p-3 border rounded-4 bg-white d-flex flex-wrap gap-3 shadow-sm">
                    @foreach($profile->self_images as $img)
                        <a href="{{ asset('public/storage/'.$img) }}" target="_blank" class="d-block border rounded-3" title="View Full Image" >
                            <img src="{{ asset('public/storage/'.$img) }}" class="rounded-3 shadow-sm" width="100" height="100" style="object-fit:cover;">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Hidden fields --}}
        <input type="hidden" name="user_id"            value="{{ old('user_id',            $profile->user_id            ?? '') }}">
        <input type="hidden" name="profile_id"         value="{{ old('profile_id',         $profile->profile_id         ?? '') }}">
        <input type="hidden" name="profile_completion" value="{{ old('profile_completion', $profile->profile_completion ?? '') }}">
        <input type="hidden" name="is_verified"        value="{{ old('is_verified',        $profile->is_verified        ?? '') }}">
        <input type="hidden" name="is_premium"         value="{{ old('is_premium',         $profile->is_premium         ?? '') }}">
        <input type="hidden" name="is_active"          value="{{ old('is_active',          $profile->is_active          ?? '1') }}">

        <div class="col-12 mt-5 mb-5 d-flex justify-content-end">
            <button type="submit" class="btn-glow px-5 py-3 fs-5">
                <i class="bi bi-floppy-fill me-2"></i> Save Candidate Profile
            </button>
        </div>

    </div>
</form>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // ─────────────────────────────────────────────
    // 1. STANDARD SELECT2 (search dropdowns)
    // ─────────────────────────────────────────────
    $('.select2').select2({ width: '100%' });
    $('#caste_picker').select2({
        width: '100%',
        placeholder: 'Select castes',
        closeOnSelect: false
    });


    // ─────────────────────────────────────────────
    // 2. DISTRICT ↔ STATE FILTER
    // ─────────────────────────────────────────────
    function filterData() { 
        var selectedOption = $('#city option:selected');

        if(selectedOption.val() !== ''){
            var State = selectedOption.data('state');
            var District = selectedOption.data('district');
            var Country = selectedOption.data('country');

            $('#state').val(State).trigger('change');
            $('#district').val(District).trigger('change');
            $('#country').val(Country).trigger('change');
        }
    }

    $('#city').on('change', filterData);

    // page load pe bhi run kare (edit case ke liye)
    $(document).ready(function () {
        filterData();
    });


    // ─────────────────────────────────────────────
    // 3. CUSTOM MULTI-TAG PICKER
    //    Works for both Caste Preferences & Area Preference
    // ─────────────────────────────────────────────
   // ─────────────────────────────────────────────
// 3. CUSTOM MULTI-TAG PICKER
// ─────────────────────────────────────────────
function initTagPicker(pickerId, displayId, hiddenId, inputName) {
    var $picker  = $('#' + pickerId);
    var $display = $('#' + displayId);
    var $hidden  = $('#' + hiddenId);

    // Destroy any previous Select2 instance first
    if ($picker.hasClass('select2-hidden-accessible')) {
        $picker.select2('destroy');
    }

    // Boot Select2
    $picker.select2({
        width: '100%',
        placeholder: 'Select to add…',
        allowClear: false
    });

    // Render existing hidden inputs as pills on page load (edit mode)
    $hidden.find('input[type="hidden"]').each(function () {
        renderTag($(this).val());
    });

    // Listen on the UNDERLYING <select> change event — more reliable than select2:select
    $picker.on('change', function () {
        var val = $(this).val();
        if (!val || val === '') return;

        // Duplicate guard
        if ($hidden.find('input[value="' + escapeAttr(val) + '"]').length === 0) {
            $hidden.append(
                '<input type="hidden" name="' + inputName + '[]" value="' + escapeAttr(val) + '">'
            );
            renderTag(val);
        }

        // Reset picker back to placeholder WITHOUT triggering change again
        $picker.val(null);
        $picker.trigger('change.select2'); // updates Select2 UI only, won't re-fire our 'change'
    });

    function renderTag(val) {
        if (!val) return;
        if ($display.find('[data-tag-val="' + escapeAttr(val) + '"]').length > 0) return;

        var $tag = $(
            '<span class="ui-tag" data-tag-val="' + escapeAttr(val) + '">' +
                escapeHtml(val) +
                '<button type="button" class="ui-tag-close" aria-label="Remove">&times;</button>' +
            '</span>'
        );

        $tag.find('.ui-tag-close').on('click', function () {
            $hidden.find('input[value="' + escapeAttr(val) + '"]').remove();
            $tag.fadeOut(150, function () { $(this).remove(); });
        });

        $display.append($tag);
    }
}

function escapeAttr(str) {
    return String(str).replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#39;');
}
function escapeHtml(str) {
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;');
}

initTagPicker('area_picker',  'area_tags_display',  'area_hidden_form_data',  'area_preference');

    // ─────────────────────────────────────────────
    // 4. HEIGHT: TWO-WAY SYNC  (Ft/In ↔ CM)
    //    A mutex flag stops each side triggering the other.
    // ─────────────────────────────────────────────
    var heightSource = null; // 'ftin' | 'cm' | null

    $('#height_feet, #height_inch').on('change', function () {
        if (heightSource === 'cm') return;          // CM is driving right now, ignore
        heightSource = 'ftin';

        var feet   = parseInt($('#height_feet').val(), 10) || 0;
        var inches = parseInt($('#height_inch').val(), 10) || 0;

        if (feet > 0 || inches > 0) {
            $('#height_cm').val(Math.round((feet * 12 + inches) * 2.54));
        } else {
            $('#height_cm').val('');
        }

        heightSource = null;
    });

    $('#partner_min_height_feet, #partner_min_height_inch').on('change', function () {
        if (heightSource === 'cm') return;          // CM is driving right now, ignore
        heightSource = 'ftin';

        var feet   = parseInt($('#partner_min_height_feet').val(), 10) || 0;
        var inches = parseInt($('#partner_min_height_inch').val(), 10) || 0;

        if (feet > 0 || inches > 0) {
            $('#partner_min_height').val(Math.round((feet * 12 + inches) * 2.54));
        } else {
            $('#partner_min_height').val('');
        }

        heightSource = null;
    });

    $('#partner_max_height_feet, #partner_max_height_inch').on('change', function () {
        if (heightSource === 'cm') return;          // CM is driving right now, ignore
        heightSource = 'ftin';

        var feet   = parseInt($('#partner_max_height_feet').val(), 10) || 0;
        var inches = parseInt($('#partner_max_height_inch').val(), 10) || 0;

        if (feet > 0 || inches > 0) {
            $('#partner_max_height').val(Math.round((feet * 12 + inches) * 2.54));
        } else {
            $('#partner_max_height').val('');
        }

        heightSource = null;
    });

    $('#height_cm').on('input', function () {
        if (heightSource === 'ftin') return;        // Ft/In is driving right now, ignore
        heightSource = 'cm';

        var cm = parseInt($(this).val(), 10) || 0;

        if (cm > 0) {
            var totalInches = Math.round(cm / 2.54);
            $('#height_feet').val(Math.floor(totalInches / 12));
            $('#height_inch').val(totalInches % 12);
        } else {
            $('#height_feet').val('');
            $('#height_inch').val('');
        }

        heightSource = null;
    });


    // ─────────────────────────────────────────────
    // 5. MARITAL STATUS → SHOW / HIDE CHILD FIELDS
    // ─────────────────────────────────────────────
    function syncMaritalFields() {
        var status = $('#marital_status').val();
        if (!status || status === 'single') {
            // Hide instantly (no animation needed — user just chose "single")
            $('.conditional-marital').hide();
        } else {
            // Reveal smoothly for any other status
            $('.conditional-marital').fadeIn(250);
        }
    }

    $('#marital_status').on('change', syncMaritalFields);

    // Run immediately so edit-mode pages show/hide correctly on first paint
    syncMaritalFields();

});


// ─────────────────────────────────────────────
// DROPZONE  (outside document.ready — Dropzone
// itself fires after DOM ready)
// ─────────────────────────────────────────────
Dropzone.autoDiscover = false;

var dz = new Dropzone('#myDropzone', {
    url: '{{ route('admin.profiles.upload-image') }}',
    maxFilesize: 5,
    maxFiles: 10,
    acceptedFiles: 'image/*',
    addRemoveLinks: true,
    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },

    success: function (file, response) {
        document.getElementById('uploadedImages').insertAdjacentHTML(
            'beforeend',
            '<input type="hidden" name="self_images[]" value="' + response.file + '">'
        );
        file.serverFilename = response.file;
    },

    removedfile: function (file) {
        if (file.serverFilename) {
            var el = document.querySelector('input[value="' + file.serverFilename + '"]');
            if (el) el.remove();
        }
        file.previewElement.remove();
    }
});
</script>
@endpush