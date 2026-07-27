<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\EmbassyArea;
use App\Models\EmbassyOccupation;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show()
    {
        $citizen = auth()->user()->citizen()->with(['area', 'occupation'])->firstOrFail();

        return view('client.profile.show', compact('citizen'));
    }

    public function edit()
    {
        $citizen = auth()->user()->citizen()->firstOrFail();
        $areas = EmbassyArea::all();
        $occupations = EmbassyOccupation::all();

        return view('client.profile.edit', compact('citizen', 'areas', 'occupations'));
    }

    public function update(Request $request)
    {
        $citizen = auth()->user()->citizen()->firstOrFail();

        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'nationality' => ['nullable', 'string', 'max:100'],
            'passport_number' => ['nullable', 'string', 'max:50'],
            'passport_expiry' => ['nullable', 'date'],
            'residence_card_number' => ['nullable', 'string', 'max:50'],
            'residence_card_expiry' => ['nullable', 'date'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'area_id' => ['nullable', 'exists:embassy_areas,id'],
            'occupation_id' => ['nullable', 'exists:embassy_occupations,id'],
            'father_name' => ['nullable', 'string', 'max:255'],
            'mother_name' => ['nullable', 'string', 'max:255'],
            'marital_status' => ['nullable', 'string', 'max:50'],
        ]);

        $citizen->update($validated);

        return redirect()->route('client.profile.show')->with('success', 'Profile updated successfully.');
    }
}
