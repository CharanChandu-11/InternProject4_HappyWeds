<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Area;
use App\Models\Caste;
use App\Models\Gotra;
use App\Models\CountryCode;
use App\Models\Education;
use App\Models\Occupation;
use App\Models\ReferBy;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Manage Profiles');
    }

    // Show all profiles
    public function index(Request $request)
    {
        $query = Profile::query();

        if ($request->name) {
            $query->where('full_name', 'LIKE', "%{$request->name}%");
        }

        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        if ($request->marital_status) {
            $query->where('marital_status', $request->marital_status);
        }

        if ($request->caste) {
            $query->where('caste', 'LIKE', "%{$request->caste}%");
        }

        if ($request->birth_place) {
            $query->where('birth_place', 'LIKE', "%{$request->birth_place}%");
        }

        if ($request->dob_from) {
            $query->whereDate('dob', '>=', $request->dob_from);
        }

        if ($request->dob_to) {
            $query->whereDate('dob', '<=', $request->dob_to);
        }

        if ($request->min_income) {
            $query->where('annual_income', '>=', $request->min_income);
        }

        if ($request->max_income) {
            $query->where('annual_income', '<=', $request->max_income);
        }

        if ($request->referenced_by) {
            $query->where('registered_by', $request->referenced_by);
        }

        $profiles = $query->latest()->paginate(100)->appends($request->query());
        $references = ReferBy::all();

        return view('profiles.index', compact('profiles', 'references'));
    }

    // Show create form
    public function create()
    {
        $Area        = Area::all();
        $Caste       = Caste::all();
        $Gotra       = Gotra::all();
        $CountryCode = CountryCode::all();
        $Education   = Education::all();
        $Occupation  = Occupation::all();
        $references = ReferBy::all();
        $subscriptionPlans = [
            ['name' => 'free', 'duration' => '1 month', 'price' => 0],
            ['name' => 'basic', 'duration' => '3 months', 'price' => 100],
            ['name' => 'premium', 'duration' => '6 months', 'price' => 180],
            ['name' => 'vip', 'duration' => '12 months', 'price' => 300],
        ];

        return view('profiles.create', compact('Area', 'Caste', 'Gotra', 'CountryCode', 'Education', 'Occupation', 'references', 'subscriptionPlans'));
    }

    // Store new profile
    public function store(Request $request)
    {
        $data = $request->validate([
            // ===== BASIC INFORMATION =====
            'title'                     => 'nullable|string|max:10',
            'first_name'                => 'required|string|max:255',
            'middle_name'               => 'nullable|string|max:255',
            'last_name'                 => 'nullable|string|max:255',
            'country_code'               => 'nullable|string|max:10',
            'mobile'                     => 'nullable|string|max:20',
            'alternate_mobile'           => 'nullable|string|max:20',
            'email'                      => 'nullable|email|max:255',
            'gender'                     => 'required|string|max:20',
            'highest_qualification'       => 'nullable|string|max:255',
            'other_qualification'         => 'nullable|string|max:255',
            'institution_name'            => 'nullable|string|max:255',

            // ===== ADDRESS =====
            'house_no'                   => 'nullable|string|max:255',
            'colony'                     => 'nullable|string|max:255',
            'street'                     => 'nullable|string|max:255',
            'landmark'                   => 'nullable|string|max:255',
            'pincode'                    => 'nullable|string|max:20',
            'city'                       => 'nullable|string|max:100',
            'taluka'                     => 'nullable|string|max:100',
            'district'                   => 'nullable|string|max:100',
            'state'                      => 'nullable|string|max:100',
            'country'                    => 'nullable|string|max:100',
            'current_address'             => 'nullable|string',
            'permanent_address'           => 'nullable|string',
            'native_place'                => 'nullable|string|max:255',

            // ===== BIRTH & PHYSICAL =====
            'dob'                        => 'nullable|date',
            'tob'                        => 'nullable|date_format:H:i',
            'birth_place'                 => 'nullable|string|max:255',
            'weight_kg'                   => 'nullable|numeric|min:0|max:300',
            'blood_group'                 => 'nullable|string|max:10',
            'complexion'                  => 'nullable|string|max:50',
            'body_type'                   => 'nullable|string|max:50',
            'physical_status'             => 'required|string|max:100',
            'hobbies'                     => 'nullable|array',
            'hobbies.*'                   => 'string|max:100',
            'interests'                   => 'nullable|array',
            'interests.*'                 => 'string|max:100',

            // ===== MARITAL STATUS =====
            'marital_status'              => 'required|string|max:50',
            'children'                    => 'nullable|integer|min:0',
            'children_living_with'        => 'nullable|string|max:255',
            'divorce_details'              => 'nullable|string',
            'widow_widower_details'        => 'nullable|string',

            // ===== PERSONAL & HOROSCOPE =====
            'mangal_dosh'                 => 'nullable|string|max:20',
            'nakshatra'                   => 'nullable|string|max:100',
            'rashi'                       => 'nullable|string|max:100',
            'charan'                      => 'nullable|string|max:50',
            'gan'                         => 'nullable|string|max:50',
            'nadi'                        => 'nullable|string|max:50',
            'gotra'                       => 'nullable|string|max:255',
            'diet'                        => 'nullable|string|max:50',
            'drinking_habits'              => 'nullable|string|max:50',
            'smoking_habits'               => 'nullable|string|max:50',
            'about_myself'                 => 'nullable|string',
            'family_values'                 => 'nullable|string',

            // ===== PROFESSIONAL =====
            'occupation'                   => 'nullable|string|max:255',
            'designation'                  => 'nullable|string|max:255',
            'company_name'                 => 'nullable|string|max:255',
            'industry'                     => 'nullable|string|max:255',
            'job_type'                     => 'nullable|string|max:50',
            'business_type'                 => 'nullable|string|max:255',
            'annual_income'                 => 'nullable|numeric|min:0',
            'self_income'                   => 'nullable|numeric|min:0',
            'family_income'                 => 'nullable|numeric|min:0',
            'budget_demand'                 => 'nullable|numeric|min:0',
            'property_details'               => 'nullable|string',
            'vehicle_details'                => 'nullable|string',

            // ===== RELIGION & COMMUNITY =====
            'religion'                     => 'nullable|string|max:100',
            'caste'                        => 'nullable|string|max:255',
            'sub_caste'                    => 'nullable|string|max:255',
            'mother_tongue'                 => 'nullable|string|max:100',
            'languages_known'               => 'nullable|array',
            'languages_known.*'             => 'string|max:100',
            'ethnicity'                     => 'nullable|string|max:100',
            'community'                     => 'nullable|string|max:100',

            // ===== FAMILY BACKGROUND =====
            'father_first'                  => 'nullable|string|max:255',
            'father_middle'                 => 'nullable|string|max:255',
            'father_last'                   => 'nullable|string|max:255',
            'father_occupation'              => 'nullable|string|max:255',
            'father_alive'                   => 'nullable|in:0,1',
            'mother_first'                   => 'nullable|string|max:255',
            'mother_middle'                  => 'nullable|string|max:255',
            'mother_last'                    => 'nullable|string|max:255',
            'mother_occupation'               => 'nullable|string|max:255',
            'mother_alive'                    => 'nullable|in:0,1',
            'family_type'                     => 'nullable|string|max:50',
            'family_status'                   => 'nullable|string|max:50',
            'no_of_brothers'                  => 'nullable|integer|min:0',
            'no_of_sisters'                   => 'nullable|integer|min:0',
            'married_brothers'                 => 'nullable|integer|min:0',
            'married_sisters'                  => 'nullable|integer|min:0',
            'family_location'                  => 'nullable|string|max:255',

            // ===== PARTNER PREFERENCES =====
            'partner_min_age'                 => 'nullable|integer|min:1900|max:2100',
            'partner_max_age'                 => 'nullable|integer|min:1900|max:2100',
            'partner_min_height'               => 'nullable|numeric|min:0',
            'partner_max_height'               => 'nullable|numeric|min:0',
            'partner_religion'                 => 'nullable|array',
            'partner_caste'                    => 'nullable|array',
            'partner_sub_caste'                => 'nullable|string|max:255',
            'partner_qualification'             => 'nullable|string|max:255',
            'partner_occupation'                => 'nullable|array',
            'partner_income'                    => 'nullable|numeric|min:0',
            'partner_country'                   => 'nullable|string|max:100',
            'partner_state'                     => 'nullable|string|max:100',
            'partner_city'                      => 'nullable|string|max:100',
            'partner_location'                  => 'nullable|string|max:255',
            'partner_marital_status'             => 'nullable|array',
            'partner_mangal_dosh'                => 'nullable|array',
            'partner_diet'                       => 'nullable|array',
            'partner_complexion'                  => 'nullable|string|max:50',
            'partner_physical_status'             => 'nullable|string|max:100',
            'partner_family_background'           => 'nullable|string',
            'partner_description'                  => 'nullable|string',
            'caste_barrier'                       => 'nullable|in:0,1',
            'partner_budget_demand'                => 'nullable|numeric|min:0',
            'horoscope'                            => 'nullable|in:0,1',
            'area_preference'                      => 'nullable|array',
            'area_preference.*'                    => 'string|max:100',
            'other_preferences'                     => 'nullable|string',

            // ===== ADDITIONAL DETAILS =====
            'expectations_from_partner'            => 'nullable|string',
            'about_family'                          => 'nullable|string',
            'hobbies_interests'                      => 'nullable|string',
            'career_ambitions'                       => 'nullable|string',
            'religious_beliefs'                       => 'nullable|string',
            'lifestyle'                               => 'nullable|string',
            'personality_traits'                       => 'nullable|string',
            'health_information'                        => 'nullable|string',
            'education_details'                          => 'nullable|json',
            'work_experience'                            => 'nullable|json',
            'skills'                                     => 'nullable|json',
            'achievements'                                => 'nullable|json',
            'travel_history'                               => 'nullable|json',
            'settlement_plans'                              => 'nullable|string',

            // ===== CONTACT PREFERENCES =====
            'contact_preference'                           => 'nullable|array',
            'contact_preference.*'                         => 'string|max:50',
            'contact_timings'                               => 'nullable|string|max:255',
            'contact_through'                                => 'nullable|string|max:255',
            'allow_direct_contact'                           => 'nullable|in:0,1',

            // ===== MEDIA (file inputs) =====
            'profile_photo'                                 => 'nullable|image|max:5120', // 5MB
            'horoscope_image'                                => 'nullable|image|max:5120',
            'family_images'                                  => 'nullable|array',
            'family_images.*'                                => 'image|max:5120',
            'video_profile'                                  => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:20480', // 20MB

            // ===== HIDDEN / SYSTEM =====
            'user_id'                                        => 'nullable|integer|exists:users,id',
            'is_active'                                      => 'nullable|in:0,1',
            'registered_by'                                  => 'nullable',
            'membership_type'                                  => 'required|string|max:50',
        ]);

        // Height conversion (feet+inch → cm)
        if ($request->filled('height_feet') || $request->filled('height_inch')) {
            $feet = (int) $request->height_feet;
            $inch = (int) $request->height_inch;
            $data['height_cm'] = round((($feet * 12) + $inch) * 2.54);
        }

        // Handle file uploads
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/profiles'), $filename);
            $path = 'profiles/' . $filename;
            $data['profile_photo'] = $path;
        }

        if ($request->hasFile('horoscope_image')) {
            $file = $request->file('horoscope_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/horoscopes'), $filename);
            $path = 'horoscopes/' . $filename;
            $data['horoscope_image'] = $path;
        }

        if ($request->hasFile('video_profile')) {
            $file = $request->file('video_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/videos'), $filename);
            $path = 'videos/' . $filename;
            $data['video_profile'] = $path;
        }

        // Multiple family images
        if ($request->hasFile('family_images')) {
            $paths = [];
            foreach ($request->file('family_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/family'), $filename);
                $paths[] = 'family/' . $filename;
            }
            $data['family_images'] = $paths;
        }

        // Handle array fields (ensure they are arrays)
        $data['languages_known']    = $request->languages_known ?? [];
        $data['area_preference']    = $request->area_preference ?? [];
        $data['self_images']        = $request->self_images ?? []; // from Dropzone
        $data['hobbies']            = $request->hobbies ?? [];
        $data['interests']          = $request->interests ?? [];
        $data['contact_preference'] = $request->contact_preference ?? [];

        // JSON fields: decode if they are strings, otherwise keep as null
        foreach (['education_details', 'work_experience', 'skills', 'achievements', 'travel_history'] as $jsonField) {
            if ($request->filled($jsonField)) {
                // Validate that it's valid JSON
                json_decode($request->$jsonField);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data[$jsonField] = json_decode($request->$jsonField, true);
                } else {
                    // If not valid JSON, store as null or skip
                    $data[$jsonField] = null;
                }
            } else {
                $data[$jsonField] = null;
            }
        }

        // Set default values for boolean fields if not present
        $booleanFields = ['father_alive', 'mother_alive', 'caste_barrier', 'horoscope', 'allow_direct_contact'];
        foreach ($booleanFields as $field) {
            if (!isset($data[$field])) {
                $data[$field] = false;
            }
        }

        // Ensure is_active default
        if (!isset($data['is_active'])) {
            $data['is_active'] = true;
        }

        // Create profile
        Profile::create($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile created successfully.');
    }

    // Show single profile
    // In your ProfileController.php
    public function show($id)
    {
        $profile = Profile::query()
            ->where('id', $id)
            ->orWhere('profile_id', $id)
            ->firstOrFail();

        // Increment view count
        $profile->incrementViews();
        
        // Calculate profile completion
        $profile->calculateProfileCompletion();
        
        // Get potential matches
        $potentialMatches = Profile::where('id', '!=', $profile->id)
            ->where('gender', $profile->gender == 'male' ? 'female' : 'male')
            ->get();
        
        // Calculate match score for each profile and sort
        $matches = $potentialMatches->map(function($match) use ($profile) {
            // Calculate match score
            $matchScore = $profile->getMatchScore($match);
            
            // Save match score to database for future use (optional)
            if ($match->match_score != $matchScore) {
                $match->match_score = $matchScore;
                $match->saveQuietly(); // Save without triggering events
            }
            
            $match->calculated_match_score = $matchScore;
            return $match;
        })
        ->filter(function($match) {
            // Only show matches with score >= 50 (adjust as needed)
            return $match->calculated_match_score >= 50;
        })
        ->sortByDesc('calculated_match_score');
        
        return view('profiles.show', compact('profile', 'matches'));
    }

    // Show edit form
    public function edit(Profile $profile)
    {
        $Area        = Area::all();
        $Caste       = Caste::all();
        $Gotra       = Gotra::all();
        $CountryCode = CountryCode::all();
        $Education   = Education::all();
        $Occupation  = Occupation::all();
        $references = ReferBy::all();
        $subscriptionPlans = [
            ['name' => 'free', 'duration' => '1 month', 'price' => 0],
            ['name' => 'basic', 'duration' => '3 months', 'price' => 100],
            ['name' => 'premium', 'duration' => '6 months', 'price' => 180],
            ['name' => 'vip', 'duration' => '12 months', 'price' => 300],
        ];

        return view('profiles.edit', compact('profile', 'Area', 'Caste', 'Gotra', 'CountryCode', 'Education', 'Occupation', 'references', 'subscriptionPlans'));
    }

    // Update profile
    public function update(Request $request, Profile $profile)
    {
        $data = $request->validate([
            // Same validation rules as store
            'title'                     => 'nullable|string|max:10',
            'first_name'                => 'required|string|max:255',
            'middle_name'               => 'nullable|string|max:255',
            'last_name'                 => 'nullable|string|max:255',
            'country_code'               => 'nullable|string|max:10',
            'mobile'                     => 'nullable|string|max:20',
            'alternate_mobile'           => 'nullable|string|max:20',
            'email'                      => 'nullable|email|max:255',
            'gender'                     => 'nullable|string|max:20',
            'highest_qualification'       => 'nullable|string|max:255',
            'other_qualification'         => 'nullable|string|max:255',
            'institution_name'            => 'nullable|string|max:255',

            'house_no'                   => 'nullable|string|max:255',
            'colony'                     => 'nullable|string|max:255',
            'street'                     => 'nullable|string|max:255',
            'landmark'                   => 'nullable|string|max:255',
            'pincode'                    => 'nullable|string|max:20',
            'city'                       => 'nullable|string|max:100',
            'taluka'                     => 'nullable|string|max:100',
            'district'                   => 'nullable|string|max:100',
            'state'                      => 'nullable|string|max:100',
            'country'                    => 'nullable|string|max:100',
            'current_address'             => 'nullable|string',
            'permanent_address'           => 'nullable|string',
            'native_place'                => 'nullable|string|max:255',

            'dob'                        => 'nullable|date',
            'tob'                        => 'nullable|date_format:H:i',
            'birth_place'                 => 'nullable|string|max:255',
            'weight_kg'                   => 'nullable|numeric|min:0|max:300',
            'blood_group'                 => 'nullable|string|max:10',
            'complexion'                  => 'nullable|string|max:50',
            'body_type'                   => 'nullable|string|max:50',
            'physical_status'             => 'nullable|string|max:100',
            'hobbies'                     => 'nullable|array',
            'hobbies.*'                   => 'string|max:100',
            'interests'                   => 'nullable|array',
            'interests.*'                 => 'string|max:100',

            'marital_status'              => 'nullable|string|max:50',
            'children'                    => 'nullable|integer|min:0',
            'children_living_with'        => 'nullable|string|max:255',
            'divorce_details'              => 'nullable|string',
            'widow_widower_details'        => 'nullable|string',

            'mangal_dosh'                 => 'nullable|string|max:20',
            'nakshatra'                   => 'nullable|string|max:100',
            'rashi'                       => 'nullable|string|max:100',
            'charan'                      => 'nullable|string|max:50',
            'gan'                         => 'nullable|string|max:50',
            'nadi'                        => 'nullable|string|max:50',
            'gotra'                       => 'nullable|string|max:255',
            'diet'                        => 'nullable|string|max:50',
            'drinking_habits'              => 'nullable|string|max:50',
            'smoking_habits'               => 'nullable|string|max:50',
            'about_myself'                 => 'nullable|string',
            'family_values'                 => 'nullable|string',

            'occupation'                   => 'nullable|string|max:255',
            'designation'                  => 'nullable|string|max:255',
            'company_name'                 => 'nullable|string|max:255',
            'industry'                     => 'nullable|string|max:255',
            'job_type'                     => 'nullable|string|max:50',
            'business_type'                 => 'nullable|string|max:255',
            'annual_income'                 => 'nullable|numeric|min:0',
            'self_income'                   => 'nullable|numeric|min:0',
            'family_income'                 => 'nullable|numeric|min:0',
            'budget_demand'                 => 'nullable|numeric|min:0',
            'property_details'               => 'nullable|string',
            'vehicle_details'                => 'nullable|string',

            'religion'                     => 'nullable|string|max:100',
            'caste'                        => 'nullable|string|max:255',
            'sub_caste'                    => 'nullable|string|max:255',
            'mother_tongue'                 => 'nullable|string|max:100',
            'languages_known'               => 'nullable|array',
            'languages_known.*'             => 'string|max:100',
            'ethnicity'                     => 'nullable|string|max:100',
            'community'                     => 'nullable|string|max:100',

            'father_first'                  => 'nullable|string|max:255',
            'father_middle'                 => 'nullable|string|max:255',
            'father_last'                   => 'nullable|string|max:255',
            'father_occupation'              => 'nullable|string|max:255',
            'father_alive'                   => 'nullable|in:0,1',
            'mother_first'                   => 'nullable|string|max:255',
            'mother_middle'                  => 'nullable|string|max:255',
            'mother_last'                    => 'nullable|string|max:255',
            'mother_occupation'               => 'nullable|string|max:255',
            'mother_alive'                    => 'nullable|in:0,1',
            'family_type'                     => 'nullable|string|max:50',
            'family_status'                   => 'nullable|string|max:50',
            'no_of_brothers'                  => 'nullable|integer|min:0',
            'no_of_sisters'                   => 'nullable|integer|min:0',
            'married_brothers'                 => 'nullable|integer|min:0',
            'married_sisters'                  => 'nullable|integer|min:0',
            'family_location'                  => 'nullable|string|max:255',

            'partner_min_age'                 => 'nullable|integer|min:1900|max:2100',
            'partner_max_age'                 => 'nullable|integer|min:1900|max:2100',
            'partner_min_height'               => 'nullable|numeric|min:0',
            'partner_max_height'               => 'nullable|numeric|min:0',
            'partner_religion'                 => 'nullable|array',
            'partner_caste'                    => 'nullable|array',
            'partner_sub_caste'                => 'nullable|string|max:255',
            'partner_qualification'             => 'nullable|string|max:255',
            'partner_occupation'                => 'nullable|array',
            'partner_income'                    => 'nullable|numeric|min:0',
            'partner_country'                   => 'nullable|string|max:100',
            'partner_state'                     => 'nullable|string|max:100',
            'partner_city'                      => 'nullable|string|max:100',
            'partner_location'                  => 'nullable|string|max:255',
            'partner_marital_status'             => 'nullable|array',
            'partner_mangal_dosh'                => 'nullable|array',
            'partner_diet'                       => 'nullable|array',
            'partner_complexion'                  => 'nullable|string|max:50',
            'partner_physical_status'             => 'nullable|string|max:100',
            'partner_family_background'           => 'nullable|string',
            'partner_description'                  => 'nullable|string',
            'caste_barrier'                       => 'nullable|in:0,1',
            'partner_budget_demand'                => 'nullable|numeric|min:0',
            'horoscope'                            => 'nullable|in:0,1',
            'area_preference'                      => 'nullable|array',
            'area_preference.*'                    => 'string|max:100',
            'other_preferences'                     => 'nullable|string',

            'expectations_from_partner'            => 'nullable|string',
            'about_family'                          => 'nullable|string',
            'hobbies_interests'                      => 'nullable|string',
            'career_ambitions'                       => 'nullable|string',
            'religious_beliefs'                       => 'nullable|string',
            'lifestyle'                               => 'nullable|string',
            'personality_traits'                       => 'nullable|string',
            'health_information'                        => 'nullable|string',
            'education_details'                          => 'nullable|json',
            'work_experience'                            => 'nullable|json',
            'skills'                                     => 'nullable|json',
            'achievements'                                => 'nullable|json',
            'travel_history'                               => 'nullable|json',
            'settlement_plans'                              => 'nullable|string',

            'contact_preference'                           => 'nullable|array',
            'contact_preference.*'                         => 'string|max:50',
            'contact_timings'                               => 'nullable|string|max:255',
            'contact_through'                                => 'nullable|string|max:255',
            'allow_direct_contact'                           => 'nullable|in:0,1',

            'profile_photo'                                 => 'nullable|image|max:5120',
            'horoscope_image'                                => 'nullable|image|max:5120',
            'family_images'                                  => 'nullable|array',
            'family_images.*'                                => 'image|max:5120',
            'video_profile'                                  => 'nullable|mimetypes:video/mp4,video/avi,video/mpeg|max:20480',

            'user_id'                                        => 'nullable|integer|exists:users,id',
            'is_active'                                      => 'nullable|in:0,1',
            'registered_by'                                  => 'nullable',
            'membership_type'                                  => 'required|string|max:50',
        ]);

        // Height conversion
        if ($request->filled('height_feet') || $request->filled('height_inch')) {
            $feet = (int) $request->height_feet;
            $inch = (int) $request->height_inch;
            $data['height_cm'] = round((($feet * 12) + $inch) * 2.54);
        }

        // Handle file uploads (delete old files if needed)
        // Handle file uploads
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/profiles'), $filename);
            $path = 'profiles/' . $filename;
            $data['profile_photo'] = $path;
        }

        if ($request->hasFile('horoscope_image')) {
            $file = $request->file('horoscope_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/horoscopes'), $filename);
            $path = 'horoscopes/' . $filename;
            $data['horoscope_image'] = $path;
        }

        if ($request->hasFile('video_profile')) {
            $file = $request->file('video_profile');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/videos'), $filename);
            $path = 'videos/' . $filename;
            $data['video_profile'] = $path;
        }

        // Multiple family images
        if ($request->hasFile('family_images')) {
            $paths = [];
            foreach ($request->file('family_images') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/family'), $filename);
                $paths[] = 'family/' . $filename;
            }
            $data['family_images'] = $paths;
        }

        // Array fields
        $data['languages_known']    = $request->languages_known ?? [];
        $data['area_preference']    = $request->area_preference ?? [];
        $data['self_images']        = $request->self_images ?? $profile->self_images; // keep existing if not sent
        $data['hobbies']            = $request->hobbies ?? [];
        $data['interests']          = $request->interests ?? [];
        $data['contact_preference'] = $request->contact_preference ?? [];

        // JSON fields
        foreach (['education_details', 'work_experience', 'skills', 'achievements', 'travel_history'] as $jsonField) {
            if ($request->filled($jsonField)) {
                json_decode($request->$jsonField);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data[$jsonField] = json_decode($request->$jsonField, true);
                } else {
                    $data[$jsonField] = null;
                }
            } else {
                $data[$jsonField] = null;
            }
        }

        // Boolean defaults
        $booleanFields = ['father_alive', 'mother_alive', 'caste_barrier', 'horoscope', 'allow_direct_contact'];
        foreach ($booleanFields as $field) {
            if (!isset($data[$field])) {
                $data[$field] = false;
            }
        }

        // Update profile
        $profile->update($data);

        return redirect()->route('admin.profiles.index')->with('success', 'Profile updated successfully.');
    }

    // Delete profile
    public function destroy(Profile $profile)
    {
        // Delete associated images
        if ($profile->profile_photo) {
            Storage::disk('public')->delete($profile->profile_photo);
        }
        if ($profile->horoscope_image) {
            Storage::disk('public')->delete($profile->horoscope_image);
        }
        if ($profile->video_profile) {
            Storage::disk('public')->delete($profile->video_profile);
        }
        if ($profile->family_images) {
            foreach ($profile->family_images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        if ($profile->self_images) {
            foreach ($profile->self_images as $img) {
                Storage::disk('public')->delete($img);
            }
        }

        $profile->delete();

        return redirect()->route('admin.profiles.index')->with('success', 'Profile deleted successfully.');
    }

    // Dropzone image upload for self_images
    public function uploadImage(Request $request)
    {
        if (!$request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded'], 400);
        }

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/profiles'), $filename);

        $path = 'profiles/' . $filename;

        return response()->json([
            'success' => true,
            'file'    => $path
        ]);
    }
}