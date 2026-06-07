<?php

namespace App\Exports;

use App\Models\Profile;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProfilesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Profile::all();
    }

    /**
     * Define the column headings.
     */
    public function headings(): array
    {
        return [
            'id',
            // BASIC INFORMATION
            'title',
            'first_name',
            'middle_name',
            'last_name',
            'full_name',
            'country_code',
            'mobile',
            'alternate_mobile',
            'email',
            'gender',
            'highest_qualification',
            'other_qualification',
            'institution_name',

            // ADDRESS
            'house_no',
            'colony',
            'street',
            'landmark',
            'pincode',
            'city',
            'taluka',
            'district',
            'state',
            'country',
            'current_address',
            'permanent_address',
            'native_place',

            // BIRTH & PHYSICAL
            'dob',
            'tob',
            'birth_place',
            'age',
            'height_cm',
            'weight_kg',
            'blood_group',
            'complexion',
            'body_type',
            'physical_status',
            'hobbies',
            'interests',

            // MARITAL STATUS
            'marital_status',
            'children',
            'children_living_with',
            'divorce_details',
            'widow_widower_details',

            // PERSONAL & HOROSCOPE
            'mangal_dosh',
            'nakshatra',
            'rashi',
            'charan',
            'gan',
            'nadi',
            'gotra',
            'diet',
            'drinking_habits',
            'smoking_habits',
            'about_myself',
            'family_values',

            // PROFESSIONAL
            'occupation',
            'designation',
            'company_name',
            'industry',
            'job_type',
            'business_type',
            'annual_income',
            'self_income',
            'family_income',
            'budget_demand',
            'property_details',
            'vehicle_details',

            // RELIGION & COMMUNITY
            'religion',
            'caste',
            'sub_caste',
            'mother_tongue',
            'languages_known',
            'ethnicity',
            'community',

            // FAMILY BACKGROUND
            'father_first',
            'father_middle',
            'father_last',
            'father_occupation',
            'father_alive',
            'mother_first',
            'mother_middle',
            'mother_last',
            'mother_occupation',
            'mother_alive',
            'family_type',
            'family_status',
            'no_of_brothers',
            'no_of_sisters',
            'married_brothers',
            'married_sisters',
            'family_location',

            // PARTNER PREFERENCES
            'partner_min_age',
            'partner_max_age',
            'partner_min_height',
            'partner_max_height',
            'partner_religion',
            'partner_caste',
            'partner_sub_caste',
            'partner_qualification',
            'partner_occupation',
            'partner_income',
            'partner_country',
            'partner_state',
            'partner_city',
            'partner_location',
            'partner_marital_status',
            'partner_mangal_dosh',
            'partner_diet',
            'partner_complexion',
            'partner_physical_status',
            'partner_family_background',
            'partner_description',
            'caste_barrier',
            'partner_budget_demand',
            'horoscope',
            'area_preference',
            'other_preferences',

            // MEDIA
            'profile_photo',
            'profile_photo_verified',
            'self_images',
            'horoscope_image',
            'family_images',
            'video_profile',

            // SYSTEM & STATUS
            'user_id',
            'profile_id',
            'profile_completion',
            'profile_views',
            'shortlisted_count',
            'is_verified',
            'verification_level',
            'verification_date',
            'is_premium',
            'premium_expiry',
            'is_active',
            'is_featured',
            'is_online',
            'last_login',
            'profile_created_by',
            'match_score',
            'privacy_settings',
            'contact_visibility',
            'photo_visibility',
            'horoscope_visibility',

            // REGISTRATION DETAILS
            'registered_by',
            'registration_date',
            'payment_status',
            'membership_type',
            'membership_expiry',

            // ADDITIONAL DETAILS
            'expectations_from_partner',
            'about_family',
            'hobbies_interests',
            'career_ambitions',
            'religious_beliefs',
            'lifestyle',
            'personality_traits',
            'health_information',
            'education_details',
            'work_experience',
            'skills',
            'achievements',
            'travel_history',
            'settlement_plans',

            // CONTACT PREFERENCES
            'contact_preference',
            'contact_timings',
            'contact_through',
            'allow_direct_contact',

            // ADMIN FIELDS
            'admin_notes',
            'admin_rating',
            'profile_score',
            'reported_count',
            'blocked_count',
            'rejection_reason',
            'approval_status',
            'approved_by',
            'approved_date',
        ];
    }

    /**
     * Map each row's data.
     */
    public function map($row): array
    {
        // Helper to convert boolean to Yes/No
        $boolToYesNo = function ($value): ?string {
            if (is_null($value)) return null;
            return $value ? 'Yes' : 'No';
        };

        // Helper for array fields -> comma separated
        $arrayToComma = function ($value): ?string {
            if (empty($value)) return null;
            if (is_array($value)) {
                return implode(',', $value);
            }
            return (string) $value;
        };

        // Helper for JSON fields -> JSON string
        $jsonToString = function ($value): ?string {
            if (empty($value)) return null;
            if (is_array($value) || is_object($value)) {
                return json_encode($value);
            }
            return (string) $value;
        };

        // Helper for dates
        $dateFormat = function ($value): ?string {
            if (empty($value)) return null;
            if ($value instanceof \Carbon\Carbon) {
                return $value->format('d-m-Y');
            }
            return (string) $value;
        };

        $dateTimeFormat = function ($value): ?string {
            if (empty($value)) return null;
            if ($value instanceof \Carbon\Carbon) {
                return $value->format('d-m-Y H:i:s');
            }
            return (string) $value;
        };

        return [
            $row->id,

            // BASIC
            $row->title,
            $row->first_name,
            $row->middle_name,
            $row->last_name,
            $row->full_name,
            $row->country_code,
            $row->mobile,
            $row->alternate_mobile,
            $row->email,
            $row->gender,
            $row->highest_qualification,
            $row->other_qualification,
            $row->institution_name,

            // ADDRESS
            $row->house_no,
            $row->colony,
            $row->street,
            $row->landmark,
            $row->pincode,
            $row->city,
            $row->taluka,
            $row->district,
            $row->state,
            $row->country,
            $row->current_address,
            $row->permanent_address,
            $row->native_place,

            // BIRTH & PHYSICAL
            $dateFormat($row->dob),
            $row->tob,
            $row->birth_place,
            $row->age,
            $row->height_cm,
            $row->weight_kg,
            $row->blood_group,
            $row->complexion,
            $row->body_type,
            $row->physical_status,
            $arrayToComma($row->hobbies),
            $arrayToComma($row->interests),

            // MARITAL
            $row->marital_status,
            $row->children,
            $row->children_living_with,
            $row->divorce_details,
            $row->widow_widower_details,

            // PERSONAL & HOROSCOPE
            $row->mangal_dosh,
            $row->nakshatra,
            $row->rashi,
            $row->charan,
            $row->gan,
            $row->nadi,
            $row->gotra,
            $row->diet,
            $row->drinking_habits,
            $row->smoking_habits,
            $row->about_myself,
            $row->family_values,

            // PROFESSIONAL
            $row->occupation,
            $row->designation,
            $row->company_name,
            $row->industry,
            $row->job_type,
            $row->business_type,
            $row->annual_income,
            $row->self_income,
            $row->family_income,
            $row->budget_demand,
            $row->property_details,
            $row->vehicle_details,

            // RELIGION
            $row->religion,
            $row->caste,
            $row->sub_caste,
            $row->mother_tongue,
            $arrayToComma($row->languages_known),
            $row->ethnicity,
            $row->community,

            // FAMILY
            $row->father_first,
            $row->father_middle,
            $row->father_last,
            $row->father_occupation,
            $boolToYesNo($row->father_alive),
            $row->mother_first,
            $row->mother_middle,
            $row->mother_last,
            $row->mother_occupation,
            $boolToYesNo($row->mother_alive),
            $row->family_type,
            $row->family_status,
            $row->no_of_brothers,
            $row->no_of_sisters,
            $row->married_brothers,
            $row->married_sisters,
            $row->family_location,

            // PARTNER PREFERENCES
            $row->partner_min_age,
            $row->partner_max_age,
            $row->partner_min_height,
            $row->partner_max_height,
            $row->partner_religion,
            $row->partner_caste,
            $row->partner_sub_caste,
            $row->partner_qualification,
            $row->partner_occupation,
            $row->partner_income,
            $row->partner_country,
            $row->partner_state,
            $row->partner_city,
            $row->partner_location,
            $row->partner_marital_status,
            $row->partner_mangal_dosh,
            $row->partner_diet,
            $row->partner_complexion,
            $row->partner_physical_status,
            $row->partner_family_background,
            $row->partner_description,
            $boolToYesNo($row->caste_barrier),
            $row->partner_budget_demand,
            $boolToYesNo($row->horoscope),
            $arrayToComma($row->area_preference),
            $row->other_preferences,

            // MEDIA
            $row->profile_photo,
            $boolToYesNo($row->profile_photo_verified),
            $arrayToComma($row->self_images),
            $row->horoscope_image,
            $arrayToComma($row->family_images),
            $row->video_profile,

            // SYSTEM
            $row->user_id,
            $row->profile_id,
            $row->profile_completion,
            $row->profile_views,
            $row->shortlisted_count,
            $boolToYesNo($row->is_verified),
            $row->verification_level,
            $dateTimeFormat($row->verification_date),
            $boolToYesNo($row->is_premium),
            $dateFormat($row->premium_expiry),
            $boolToYesNo($row->is_active),
            $boolToYesNo($row->is_featured),
            $boolToYesNo($row->is_online),
            $dateTimeFormat($row->last_login),
            $row->profile_created_by,
            $row->match_score,
            $jsonToString($row->privacy_settings),
            $row->contact_visibility,
            $row->photo_visibility,
            $row->horoscope_visibility,

            // REGISTRATION
            $row->refer_by ? $row->refer_by->name : null,
            $dateTimeFormat($row->registration_date),
            $boolToYesNo($row->payment_status),
            $row->membership_type,
            $dateFormat($row->membership_expiry),

            // ADDITIONAL DETAILS
            $row->expectations_from_partner,
            $row->about_family,
            $row->hobbies_interests,
            $row->career_ambitions,
            $row->religious_beliefs,
            $row->lifestyle,
            $row->personality_traits,
            $row->health_information,
            $jsonToString($row->education_details),
            $jsonToString($row->work_experience),
            $jsonToString($row->skills),
            $jsonToString($row->achievements),
            $jsonToString($row->travel_history),
            $row->settlement_plans,

            // CONTACT PREFERENCES
            $arrayToComma($row->contact_preference),
            $row->contact_timings,
            $row->contact_through,
            $boolToYesNo($row->allow_direct_contact),

            // ADMIN
            $row->admin_notes,
            $row->admin_rating,
            $row->profile_score,
            $row->reported_count,
            $row->blocked_count,
            $row->rejection_reason,
            $row->approval_status,
            $row->approved_by,
            $dateTimeFormat($row->approved_date),
        ];
    }
}