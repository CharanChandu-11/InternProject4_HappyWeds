<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalProfiles = Profile::count();
        $todayProfiles = Profile::whereDate('created_at', now()->toDateString())->count();
        $todayProfilesUpdated = Profile::whereDate('updated_at', now()->toDateString())->count();
        $thisMonthProfiles = Profile::whereMonth('created_at', now()->month)->count();
        $pendingProfiles = Profile::where('approval_status', 'pending')->count();

        $freeProfiles = Profile::where('membership_type', 'free')->count();
        $basicProfiles = Profile::where('membership_type', 'basic')->count();
        $premiumProfiles = Profile::where('membership_type', 'premium')->count();
        $vipProfiles = Profile::where('membership_type', 'vip')->count();

        $recentProfiles = Profile::latest()->take(5)->get();



        
        
        // Passing dummy data for now so you can see the layout
        $stats = [
            'total_users' => $totalUsers,
            'total_profiles' => $totalProfiles,
            'new_profiles_today' => $todayProfiles,
            'updated_profiles_today' => $todayProfilesUpdated,
            'new_profiles_this_month' => $thisMonthProfiles,
            'free_profiles' => $freeProfiles,
            'basic_profiles' => $basicProfiles,
            'premium_profiles' => $premiumProfiles,
            'vip_profiles' => $vipProfiles,
            'pending_profiles' => $pendingProfiles,
            'recent_profiles' => $recentProfiles,
        ];

        return view('admin.dashboard', compact('stats'));
    }
}