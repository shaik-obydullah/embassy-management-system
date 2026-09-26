<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\EmbassyService;

class ServiceController extends Controller
{
    public function index()
    {
        $services = EmbassyService::where('is_active', true)
            ->orderBy('category')
            ->get();

        return view('client.services.index', compact('services'));
    }
}
