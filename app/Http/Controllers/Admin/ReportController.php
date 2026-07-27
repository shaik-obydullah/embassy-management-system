<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyAppointment;
use App\Models\EmbassyCitizen;
use App\Models\EmbassyConsular;
use App\Models\EmbassyPassport;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $totalCitizens = EmbassyCitizen::count();
        $totalAppointments = EmbassyAppointment::count();
        $totalPassports = EmbassyPassport::count();
        $totalConsulars = EmbassyConsular::count();

        $monthlyAppointments = EmbassyAppointment::where('created_at', '>=', Carbon::now()->subMonths(12))
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $appointmentsByStatus = EmbassyAppointment::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $passportsByStatus = EmbassyPassport::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $citizensByArea = EmbassyCitizen::whereNotNull('area_id')
            ->selectRaw('area_id, COUNT(*) as count')
            ->groupBy('area_id')
            ->with('area')
            ->get();

        return view('admin.reports.index', compact(
            'totalCitizens',
            'totalAppointments',
            'totalPassports',
            'totalConsulars',
            'monthlyAppointments',
            'appointmentsByStatus',
            'passportsByStatus',
            'citizensByArea',
        ));
    }
}
