<?php

namespace App\Http\Controllers;

use App\Models\EmbassyService;

class HomeController extends Controller
{
    public function index()
    {
        $services = EmbassyService::where('is_active', true)->latest()->take(6)->get();

        return view('pages.home', compact('services'));
    }

    public function services()
    {
        $services = EmbassyService::where('is_active', true)
            ->get();

        return view('pages.services', compact('services'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
