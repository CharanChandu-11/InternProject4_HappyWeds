<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        // ===== BASIC INFORMATION =====
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
        
        // ===== ADDRESS =====
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
        
        // ===== BIRTH & PHYSICAL =====
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
        
        // ===== MARITAL STATUS =====
        'marital_status',
        'children',
        'children_living_with',
        'divorce_details',
        'widow_widower_details',
        
        // ===== PERSONAL & HOROSCOPE =====
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
        
        // ===== PROFESSIONAL =====
        'occupation',
        'designation',
        'company_name',
        'industry',
        'job_type',
        'business_type',
        'annual_income',
        'self_income',
        'family_income',
        'property_details',
        'vehicle_details',
        'budget_demand',
        
        // ===== RELIGION & COMMUNITY =====
        'religion',
        'caste',
        'sub_caste',
        'mother_tongue',
        'languages_known',
        'ethnicity',
        'community',
        
        // ===== FAMILY BACKGROUND =====
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
        
        // ===== PARTNER PREFERENCES =====
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
        
        // ===== MEDIA =====
        'profile_photo',
        'profile_photo_verified',
        'self_images',
        'horoscope_image',
        'family_images',
        'video_profile',
        
        // ===== SYSTEM & STATUS =====
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
        
        // ===== REGISTRATION DETAILS =====
        'registered_by',
        'registration_date',
        'payment_status',
        'membership_type',
        'membership_expiry',
        
        // ===== ADDITIONAL DETAILS =====
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
        
        // ===== CONTACT PREFERENCES =====
        'contact_preference',
        'contact_timings',
        'contact_through',
        'allow_direct_contact',
        
        // ===== ADMIN FIELDS =====
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

    protected $casts = [
        // Dates
        'dob' => 'date',
        'verification_date' => 'datetime',
        'premium_expiry' => 'datetime',
        'last_login' => 'datetime',
        'registration_date' => 'datetime',
        'membership_expiry' => 'datetime',
        'approved_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        
        // Arrays
        'languages_known' => 'array',
        'self_images' => 'array',
        'family_images' => 'array',
        'area_preference' => 'array',
        'partner_religion' => 'array',
        'partner_caste' => 'array',
        'partner_occupation' => 'array',
        'partner_marital_status' => 'array',
        'partner_mangal_dosh' => 'array',
        'partner_diet' => 'array',
        'hobbies' => 'array',
        'interests' => 'array',
        'education_details' => 'array',
        'work_experience' => 'array',
        'skills' => 'array',
        'achievements' => 'array',
        'travel_history' => 'array',
        'privacy_settings' => 'array',
        'contact_preference' => 'array',
        
        // Numbers
        'height_cm' => 'float',
        'weight_kg' => 'float',
        'annual_income' => 'float',
        'self_income' => 'float',
        'family_income' => 'float',
        'budget_demand' => 'float',
        'partner_income' => 'float',
        'partner_budget_demand' => 'float',
        'partner_min_age' => 'integer',
        'partner_max_age' => 'integer',
        'partner_min_height' => 'float',
        'partner_max_height' => 'float',
        'no_of_brothers' => 'integer',
        'no_of_sisters' => 'integer',
        'married_brothers' => 'integer',
        'married_sisters' => 'integer',
        'children' => 'integer',
        'profile_views' => 'integer',
        'shortlisted_count' => 'integer',
        'profile_completion' => 'integer',
        'match_score' => 'integer',
        'admin_rating' => 'integer',
        'profile_score' => 'integer',
        'reported_count' => 'integer',
        'blocked_count' => 'integer',
        
        // Booleans
        'is_verified' => 'boolean',
        'is_premium' => 'boolean',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'is_online' => 'boolean',
        'profile_photo_verified' => 'boolean',
        'caste_barrier' => 'boolean',
        'horoscope' => 'boolean',
        'father_alive' => 'boolean',
        'mother_alive' => 'boolean',
        'allow_direct_contact' => 'boolean',
        'payment_status' => 'boolean',
    ];

    protected $appends = [
        'full_name',
        'height_feet',
        'age_years',
        'profile_photo_url',
        'verification_badge',
        'premium_badge',
        'online_status',
        'income_formatted',
        'partner_age_range',
        'partner_height_range',
    ];

    /* ================= RELATIONSHIPS ================= */
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function shortlists()
    {
        return $this->hasMany(Shortlist::class);
    }
    
    public function shortlistedBy()
    {
        return $this->belongsToMany(User::class, 'shortlists', 'profile_id', 'user_id')
                    ->withTimestamps();
    }
    
    public function profileMatches()
    {
        return $this->hasMany(ProfileMatch::class, 'profile1_id');
    }
    
    public function matchedBy()
    {
        return $this->hasMany(ProfileMatch::class, 'profile2_id');
    }
    
    public function messagesSent()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
    
    public function messagesReceived()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }
    
    public function interestsSent()
    {
        return $this->hasMany(Interest::class, 'sender_id');
    }
    
    public function interestsReceived()
    {
        return $this->hasMany(Interest::class, 'receiver_id');
    }
    
    public function views()
    {
        return $this->hasMany(ProfileView::class);
    }
    
    public function reportsMade()
    {
        return $this->hasMany(ProfileReport::class, 'reporter_id');
    }
    
    public function reportsReceived()
    {
        return $this->hasMany(ProfileReport::class, 'reported_profile_id');
    }
    
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /* ================= ACCESSORS ================= */

    public function getFullNameAttribute()
    {
        $name = $this->first_name;
        if ($this->middle_name) {
            $name .= ' ' . $this->middle_name;
        }
        if ($this->last_name) {
            $name .= ' ' . $this->last_name;
        }
        
        return $name;
    }

    public function getHeightFeetAttribute()
    {
        if (!$this->height_cm) return null;
        
        $inches = $this->height_cm / 2.54;
        $feet = floor($inches / 12);
        $remainingInches = round($inches - ($feet * 12));
        
        return "{$feet}'{$remainingInches}\"";
    }
    

    public function getAgeYearsAttribute()
    {
        if (!$this->dob) return null;
        $age = now()->diffInYears($this->dob);
        return round(abs($age));
    }

    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('public/storage/' . $this->profile_photo);
        }
        
        return $this->gender == 'male' 
            ? asset('public/images/default-male.png')
            : asset('public/images/default-female.png');
    }

    public function getVerificationBadgeAttribute()
    {
        if ($this->is_verified) {
            return [
                'text' => 'Verified',
                'color' => 'success',
                'icon' => 'check-circle'
            ];
        }
        return null;
    }

    public function getPremiumBadgeAttribute()
    {
        if ($this->is_premium && $this->premium_expiry > now()) {
            return [
                'text' => 'Premium',
                'color' => 'warning',
                'icon' => 'star-fill'
            ];
        }
        return null;
    }

    public function getOnlineStatusAttribute()
    {
        if ($this->last_login && $this->last_login->diffInMinutes(now()) < 5) {
            return [
                'online' => true,
                'text' => 'Online Now',
                'color' => 'success'
            ];
        }
        return [
            'online' => false,
            'text' => 'Offline',
            'color' => 'secondary'
        ];
    }

    public function getIncomeFormattedAttribute()
    {
        if (!$this->annual_income) return null;
        
        if ($this->annual_income >= 10000000) {
            return '₹ ' . number_format($this->annual_income / 10000000, 1) . ' Cr';
        } elseif ($this->annual_income >= 100000) {
            return '₹ ' . number_format($this->annual_income / 100000, 1) . ' Lakh';
        } else {
            return '₹ ' . number_format($this->annual_income);
        }
    }

    public function getPartnerAgeRangeAttribute()
    {
        if ($this->partner_min_age && $this->partner_max_age) {
            return "{$this->partner_min_age} - {$this->partner_max_age} years";
        }
        return null;
    }

    public function getPartnerHeightRangeAttribute()
    {
        if ($this->partner_min_height && $this->partner_max_height) {
            $minFeet = floor($this->partner_min_height / 30.48);
            $minInches = round(($this->partner_min_height - ($minFeet * 30.48)) / 2.54);
            $maxFeet = floor($this->partner_max_height / 30.48);
            $maxInches = round(($this->partner_max_height - ($maxFeet * 30.48)) / 2.54);
            
            return "{$minFeet}'{$minInches}\" - {$maxFeet}'{$maxInches}\"";
        }
        return null;
    }

    /* ================= SCOPES ================= */

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopePremium($query)
    {
        return $query->where('is_premium', true)
                     ->where('premium_expiry', '>', now());
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOnline($query)
    {
        return $query->where('is_online', true)
                     ->orWhere('last_login', '>', now()->subMinutes(5));
    }

    public function scopeByGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeByAgeRange($query, $minAge, $maxAge)
    {
        $minDate = now()->subYears($maxAge)->format('Y-m-d');
        $maxDate = now()->subYears($minAge)->format('Y-m-d');
        
        return $query->whereBetween('dob', [$minDate, $maxDate]);
    }

    public function scopeByReligion($query, $religion)
    {
        return $query->where('religion', $religion);
    }

    public function scopeByCaste($query, $caste)
    {
        return $query->where('caste', $caste);
    }

    public function scopeByLocation($query, $location)
    {
        return $query->where('city', 'like', "%{$location}%")
                     ->orWhere('state', 'like', "%{$location}%")
                     ->orWhere('country', 'like', "%{$location}%");
    }

    public function scopeByEducation($query, $education)
    {
        return $query->where('highest_qualification', 'like', "%{$education}%")
                     ->orWhere('other_qualification', 'like', "%{$education}%");
    }

    public function scopeByOccupation($query, $occupation)
    {
        return $query->where('occupation', 'like', "%{$occupation}%");
    }

    public function scopeByIncomeRange($query, $minIncome, $maxIncome)
    {
        return $query->whereBetween('annual_income', [$minIncome, $maxIncome]);
    }

    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }

    public function scopePendingApproval($query)
    {
        return $query->where('approval_status', 'pending');
    }

    /* ================= CUSTOM METHODS ================= */

    public function calculateProfileCompletion()
    {
        $importantFields = [
            'first_name', 'gender', 'dob', 'height_cm', 'marital_status',
            'religion', 'caste', 'highest_qualification', 'occupation',
            'annual_income', 'country', 'state', 'city', 'profile_photo',
            'about_myself', 'family_values', 'partner_description', 'area_preference', 
            'partner_min_age', 'partner_max_age', 'budget_demand', 'partner_budget_demand',
        ];
        
        $filledFields = 0;
        foreach ($importantFields as $field) {
            if (!empty($this->$field)) {
                $filledFields++;
            }
        }
       $completion = ($filledFields / count($importantFields)) * 100;
$this->profile_completion = round($completion);

// Only save to the database if this profile has already been created
if ($this->exists) {
    $this->saveQuietly();
}

return $this->profile_completion;
    }

    public function updateLastLogin()
    {
        $this->update([
            'last_login' => now(),
            'is_online' => true,
        ]);
        
        return $this;
    }

    public function incrementViews()
    {
        $this->increment('profile_views', 1, []);
        return $this;
    }

    public function incrementShortlisted()
    {
        $this->increment('shortlisted_count', 1, []);
        return $this;
    }

    public function getMatchScore(Profile $otherProfile, $detailed = false)
    {
        $score = 0;
        $total = 200;
        $points = [];
        
        // Age compatibility
        if ($this->partner_min_age && $this->partner_max_age && $otherProfile->age_years) {
            $age = $otherProfile->age_years;
            $minAge = date('Y') - $this->partner_min_age;
            $maxAge = date('Y') - $this->partner_max_age;
            if ($age >= $minAge && $age <= $maxAge) {
                $score += 20;
                $points[] = "Age";
            }
        }
        
        // Height compatibility
        if ($this->partner_min_height && $this->partner_max_height && $otherProfile->height_cm) {
            $height = $otherProfile->height_cm;
            if ($height >= $this->partner_min_height && $height <= $this->partner_max_height) {
                $score += 20;
                $points[] = "Height";
            }
        }

        if ($this->partner_religion && is_array($this->partner_religion) && $otherProfile->religion) {
            if (in_array($otherProfile->religion, $this->partner_religion)) {
                $score += 10;
                $points[] = "Religion";
            }
        }

        if ($this->partner_caste && is_array($this->partner_caste) && $otherProfile->caste) {
            if (in_array($otherProfile->caste, $this->partner_caste)) {
                $score += 10;
                $points[] = "Caste";
            }elseif($this->caste_barrier == 'no'){
                $score += 5; 
                $points[] = "Caste barrier not an issue";
            }
        }

        if ($this->partner_occupation && is_array($this->partner_occupation) && $otherProfile->occupation) {
            foreach ($this->partner_occupation as $occupation) {
                if (stripos($otherProfile->occupation, $occupation) !== false || 
                    stripos($otherProfile->designation, $occupation) !== false || 
                    stripos($otherProfile->industry, $occupation) !== false) {
                    $score += 10;
                    $points[] = "Occupation";
                    break;
                }
            }
        }

        if ($this->partner_marital_status && is_array($this->partner_marital_status) && $otherProfile->marital_status) {
            if (in_array($otherProfile->marital_status, $this->partner_marital_status)) {
                $score += 10;
                $points[] = "Marital status";
            }
        }

        if ($this->partner_mangal_dosh && is_array($this->partner_mangal_dosh) && $otherProfile->mangal_dosh) {
            if (in_array($otherProfile->mangal_dosh, $this->partner_mangal_dosh)) {
                $score += 10;
                $points[] = "Mangal Dosh";
            }
        }

        if ($this->partner_diet && is_array($this->partner_diet) && $otherProfile->diet) {
            if (in_array($otherProfile->diet, $this->partner_diet)) {
                $score += 10;
                $points[] = "Diet";
            }
        }

        if($this->partner_physical_status && $otherProfile->physical_status) {
            if ($otherProfile->physical_status == $this->partner_physical_status) {
                $score += 10;
                $points[] = "Physical status";
            }
        }

        if ($this->area_preference && is_array($this->area_preference) && $otherProfile->city) {
            foreach ($this->area_preference as $location) {
                if (stripos($otherProfile->city, $location) !== false || 
                    stripos($otherProfile->state, $location) !== false) {
                    $score += 40;
                    $points[] = "Location";
                    break;
                }
            }
        }
        
        if ($this->partner_income && $otherProfile->self_income) {
            if ($otherProfile->self_income >= $this->partner_income) {
                $score += 25;
                $points[] = "Income";
                if($this->partner_budget_demand && $otherProfile->self_income <= $this->partner_budget_demand) {
                    $score += 25;
                    $points[] = "Budget demand";
                }
            }
        }
        
        if ($detailed) {
            return [
                'score' => $score,
                'total' => $total,
                'percentage' => $total > 0 ? round(($score / $total) * 100) : 0,
                'points' => $points
            ];
        }
        
        return $total > 0 ? round(($score / $total) * 100) : 0;
    }

    public function isCompatibleWith(Profile $otherProfile)
    {
        return $this->getMatchScore($otherProfile) >= 70;
    }

    public function isOnline()
    {
        return $this->last_login && $this->last_login->diffInMinutes(now()) < 5;
    }

    public function isPremiumActive()
    {
        return $this->is_premium && $this->premium_expiry && $this->premium_expiry > now();
    }

    public function canViewContact(Profile $viewer)
    {
        if ($this->contact_visibility === 'public') {
            return true;
        }
        
        if ($this->contact_visibility === 'premium' && $viewer->isPremiumActive()) {
            return true;
        }
        
        if ($this->contact_visibility === 'mutual_interest') {
            // Check if there's mutual interest between profiles
            return Interest::where(function($query) use ($viewer) {
                $query->where('sender_id', $this->user_id)
                      ->where('receiver_id', $viewer->user_id)
                      ->where('status', 'accepted');
            })->orWhere(function($query) use ($viewer) {
                $query->where('sender_id', $viewer->user_id)
                      ->where('receiver_id', $this->user_id)
                      ->where('status', 'accepted');
            })->exists();
        }
        
        return false;
    }

    /* ================= EVENTS ================= */

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($profile) {
            // Generate profile ID
            if (!$profile->profile_id) {
                $profile->profile_id = 'PRO' . strtoupper(substr(md5(uniqid() . microtime()), 0, 8));
            }
            
            // Set registration date
            if (!$profile->registration_date) {
                $profile->registration_date = now();
            }
            
            // Calculate age from DOB
            if ($profile->dob && !$profile->age) {
                $profile->age = $profile->dob->diffInYears(now());
            }
            
            // Set full name
            $profile->full_name = trim("{$profile->first_name} {$profile->middle_name} {$profile->last_name}");
            
            // Set default privacy settings
            if (!$profile->privacy_settings) {
                $profile->privacy_settings = [
                    'profile_visible' => true,
                    'contact_visible' => 'mutual_interest',
                    'photo_visible' => 'all',
                ];
            }
        });
        
        static::updating(function ($profile) {
            // Update age if DOB changed
            if ($profile->isDirty('dob') && $profile->dob) {
                $profile->age = $profile->dob->diffInYears(now());
            }
            
            // Update full name if name parts changed
            if ($profile->isDirty(['first_name', 'middle_name', 'last_name'])) {
                $profile->full_name = trim("{$profile->first_name} {$profile->middle_name} {$profile->last_name}");
            }
        });
        
        static::saving(function ($profile) {
            // Auto-calculate profile completion
            if ($profile->isDirty() && !$profile->profile_completion) {
                // This can be expensive, so you might want to run it on a queue
                // $profile->calculateProfileCompletion();
            }
        });
    }
}