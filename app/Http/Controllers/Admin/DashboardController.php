<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyActivity;
use App\Models\EmbassyAppointment;
use App\Models\EmbassyCitizen;
use App\Models\EmbassyPassport;
use App\Models\EmbassyService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCitizens = EmbassyCitizen::count();
        $totalServices = EmbassyService::count();
        $todayAppointments = EmbassyAppointment::whereDate('created_at', Carbon::today())->count();
        $pendingPassports = EmbassyPassport::where('status', 'pending')->count();

        $recentActivities = EmbassyActivity::with('user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalCitizens',
            'totalServices',
            'todayAppointments',
            'pendingPassports',
            'recentActivities',
        ));
    }
}
