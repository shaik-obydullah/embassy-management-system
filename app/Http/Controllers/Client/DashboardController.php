<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user()->load('citizen');
        $appointments = auth()->user()->appointments()
            ->with(['service', 'slot'])
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard', compact('user', 'appointments'));
    }
}
