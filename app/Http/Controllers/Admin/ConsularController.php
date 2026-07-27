<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyConsular;

class ConsularController extends Controller
{
    public function index()
    {
        $consulars = EmbassyConsular::with(['citizen', 'user', 'service'])->latest()->paginate(15);

        return view('admin.consulars.index', compact('consulars'));
    }

    public function show($id)
    {
        $consular = EmbassyConsular::with(['citizen', 'user', 'service'])->findOrFail($id);

        return view('admin.consulars.show', compact('consular'));
    }
}
