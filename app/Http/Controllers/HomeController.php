<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\SuccessStory;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the matrimony home page.
     */
    public function index()
    {
        if (Auth::check()) {
            $profile = Profile::where('user_id', Auth::id())->first();
        }
        if (Auth::check() && $profile) {

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
            $data = [
                'featuredProfiles' => $matches->take(4), // Show top 4 matches
                'successStories' => [
                    [
                        'couple' => 'Rahul & Sneha',
                        'quote' => 'We connected through HappilyWeds and found our perfect match. The platform made it easy to find someone who shared our values and life goals.',
                        'image' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'June 2022',
                        'location' => 'Mumbai'
                    ],
                    [
                        'couple' => 'Vikram & Priya',
                        'quote' => 'As busy professionals, we never had time to meet people. HappilyWeds helped us connect and we found our soulmate within 3 months!',
                        'image' => 'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'March 2023',
                        'location' => 'Bangalore'
                    ],
                    [
                        'couple' => 'Arun & Meera',
                        'quote' => 'The verification process gave us confidence in the platform. We found genuine people and now we\'re happily married with a beautiful family.',
                        'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'December 2022',
                        'location' => 'Chennai'
                    ],
                ],
            ];
        }else{
            $data = [
                'featuredProfiles' => [
                    [
                        'id' => 1,
                        'name' => 'Priya Sharma',
                        'age' => 28,
                        'image' => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'profession' => 'Software Engineer',
                        'location' => 'Bangalore',
                        'education' => 'MCA',
                        'verified' => true
                    ],
                    [
                        'id' => 2,
                        'name' => 'Raj Patel',
                        'age' => 32,
                        'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'profession' => 'Business Consultant',
                        'location' => 'Mumbai',
                        'education' => 'MBA',
                        'verified' => true
                    ],
                    [
                        'id' => 3,
                        'name' => 'Anjali Reddy',
                        'age' => 26,
                        'image' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'profession' => 'Doctor',
                        'location' => 'Hyderabad',
                        'education' => 'MBBS',
                        'verified' => true
                    ],
                    [
                        'id' => 4,
                        'name' => 'Amit Kumar',
                        'age' => 30,
                        'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'profession' => 'Civil Engineer',
                        'location' => 'Delhi',
                        'education' => 'B.Tech',
                        'verified' => true
                    ],
                ],
                'successStories' => [
                    [
                        'couple' => 'Rahul & Sneha',
                        'quote' => 'We connected through HappilyWeds and found our perfect match. The platform made it easy to find someone who shared our values and life goals.',
                        'image' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'June 2022',
                        'location' => 'Mumbai'
                    ],
                    [
                        'couple' => 'Vikram & Priya',
                        'quote' => 'As busy professionals, we never had time to meet people. HappilyWeds helped us connect and we found our soulmate within 3 months!',
                        'image' => 'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'March 2023',
                        'location' => 'Bangalore'
                    ],
                    [
                        'couple' => 'Arun & Meera',
                        'quote' => 'The verification process gave us confidence in the platform. We found genuine people and now we\'re happily married with a beautiful family.',
                        'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                        'date' => 'December 2022',
                        'location' => 'Chennai'
                    ],
                ]
            ];
        }
        

        return view('pages.home', $data);
    }

    
    /**
     * Show profiles listing page.
     */
    public function profiles(Request $request)
    {
        // In real app, fetch from database with filters
        $profiles = []; // Fetch profiles based on filters
        
        return view('pages.profiles.index', compact('profiles'));
    }

    /**
     * Show profile detail page.
     */
    public function profileDetail($id)
    {
        // In real app, fetch profile by ID
        $profile = []; // Fetch profile
        
        return view('pages.profiles.detail', compact('profile'));
    }

    /**
     * Show search results.
     */
    public function search(Request $request)
    {
        $validated = $request->validate([
            'gender' => 'required|in:male,female',
            'religion' => 'nullable|string',
            'age' => 'nullable|string',
            'location' => 'nullable|string'
        ]);

        // In real app, search profiles in database
        $results = []; // Search logic
        
        return view('pages.search.results', compact('results', 'validated'));
    }
public function dashboard()
    {
        // Fetch all the necessary data for the Edit Profile dropdowns
        $Area = \App\Models\Area::all(); 
        $Caste = \App\Models\Caste::all();
        $CountryCode = \App\Models\CountryCode::all();
        $Education = \App\Models\Education::all();
        $Occupation = \App\Models\Occupation::all();
        $Gotra = \App\Models\Gotra::all();

        // Pass the data to the user dashboard view
        return view('users.dashboard', compact(
            'Area', 'Caste', 'CountryCode', 'Education', 'Occupation', 'Gotra'
        ));
    }
    /**
     * Show registration page.
     */
    public function successStories()
    {
        $data = [
            'stories' => [
                [
                    'couple' => 'Aarav & Ananya',
                    'profession' => 'Doctor & Architect',
                    'location' => 'Mumbai, India',
                    'date' => 'December 10, 2023',
                    'quote' => 'We connected instantly despite being from different professional backgrounds. HappilyWeds helped us find common ground and build a beautiful relationship.',
                    'image' => 'https://images.unsplash.com/photo-1539635278303-d4002c07eae3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'recent',
                    'full_story' => 'Aarav and Ananya met through HappilyWeds in early 2023. Despite their busy schedules - Aarav as a surgeon and Ananya as a leading architect - they found time to connect through our platform. Their first meeting was magical, and they realized they shared the same values and life goals. Today, they\'re happily married and planning their dream home together.'
                ],
                [
                    'couple' => 'Rohan & Sneha',
                    'profession' => 'Software Engineer & Teacher',
                    'location' => 'Bangalore, India & New York, USA',
                    'date' => 'October 5, 2023',
                    'quote' => 'Long distance couldn\'t keep us apart! Thanks to HappilyWeds, we bridged continents and cultures to find true love.',
                    'image' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'long-distance',
                    'full_story' => 'Rohan was working in Bangalore while Sneha was teaching in New York. They connected through our international matching system. Despite the 10.5-hour time difference, they made it work with scheduled video calls and messages. After 8 months of long-distance dating, Rohan proposed during a surprise visit to New York. They now live together in San Francisco.'
                ],
                [
                    'couple' => 'Vikram & Meera',
                    'profession' => 'Businessman & Artist',
                    'location' => 'Delhi, India',
                    'date' => 'August 20, 2023',
                    'quote' => 'Our families had reservations about inter-caste marriage, but HappilyWeds provided the support and counseling we needed.',
                    'image' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'inter-caste',
                    'full_story' => 'Vikram and Meera come from different cultural backgrounds but shared a deep connection from their first conversation. Through HappilyWeds\' counseling services, they were able to navigate family expectations and cultural differences. Their wedding was a beautiful blend of both traditions, celebrating love beyond boundaries.'
                ],
                [
                    'couple' => 'Aditya & Pooja',
                    'profession' => 'Entrepreneur & Lawyer',
                    'location' => 'Chennai, India',
                    'date' => 'June 15, 2023',
                    'quote' => 'Finding love again seemed impossible until we discovered HappilyWeds. Second chances do exist!',
                    'image' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'second-marriage',
                    'full_story' => 'Both Aditya and Pooja had previous marriages that didn\'t work out. They were hesitant to try again but decided to give HappilyWeds a chance. Their maturity and life experiences helped them connect on a deeper level. Today, they\'re building a beautiful blended family with their children from previous marriages.'
                ],
                [
                    'couple' => 'Karan & Simran',
                    'profession' => 'Chef & Journalist',
                    'location' => 'Goa, India',
                    'date' => 'April 2, 2023',
                    'quote' => 'From a simple chat to a lifetime of love. HappilyWeds made our fairytale come true!',
                    'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'love-marriage',
                    'full_story' => 'Karan and Simran\'s love story began with a casual chat about food - his specialty as a chef and her passion as a food journalist. Their conversations grew from professional to personal, and soon they realized they had found their soulmate. Their beach wedding in Goa was attended by friends and family who had supported their journey.'
                ],
                [
                    'couple' => 'Arjun & Neha',
                    'profession' => 'Pilot & Fashion Designer',
                    'location' => 'Dubai, UAE',
                    'date' => 'February 14, 2023',
                    'quote' => 'Love knows no borders! From different countries to one heart, HappilyWeds brought us together.',
                    'image' => 'https://images.unsplash.com/photo-1529254479751-fbacb4c7a587?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
                    'avatar' => 'https://images.unsplash.com/photo-1487412720507-e7ab37603c6f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
                    'category' => 'long-distance',
                    'full_story' => 'Arjun, an airline pilot from Dubai, and Neha, a fashion designer from Mumbai, found each other through our international matching. Their busy schedules meant they had to be creative with their dating - airport meetups, video calls during layovers, and surprise visits. Their Valentine\'s Day wedding was a celebration of love overcoming distance.'
                ],
            ],
            'videoStories' => [
                [
                    'id' => 'video1',
                    'title' => 'A Cross-Cultural Love Story',
                    'couple' => 'Raj & Priya',
                    'description' => 'Watch how they bridged cultural differences to find true love.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 'video2',
                    'title' => 'Second Chance at Happiness',
                    'couple' => 'Aditya & Pooja',
                    'description' => 'Inspiring story of finding love again after difficult times.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
                [
                    'id' => 'video3',
                    'title' => 'From Chat to Wedding Bells',
                    'couple' => 'Karan & Simran',
                    'description' => 'Beautiful journey of a connection that started online.',
                    'thumbnail' => 'https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ],
            ]
        ];

        return view('pages.success-stories', $data);
    }

    public function about()
    {
        return view('pages.about');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function terms()
    {
        return view('pages.terms');
    }

    public function planning()
    {
        return view('pages.planning');
    }

}
