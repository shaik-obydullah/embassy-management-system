<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyPassport;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function index()
    {
        $passports = EmbassyPassport::with('citizen')->latest()->paginate(15);

        return view('admin.passports.index', compact('passports'));
    }

    public function show($id)
    {
        $passport = EmbassyPassport::with(['citizen', 'user'])->findOrFail($id);

        return view('admin.passports.show', compact('passport'));
    }

    public function updateStatus(Request $request, $id)
    {
        $passport = EmbassyPassport::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,processing,ready,delivered,rejected'],
        ]);

        $passport->update($validated);

        return back()->with('success', 'Passport status updated successfully.');
    }
}
