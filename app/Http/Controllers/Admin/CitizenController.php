<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyCitizen;
use App\Models\EmbassyArea;
use App\Models\EmbassyOccupation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CitizenController extends Controller
{
    public function index(Request $request)
    {
        $query = EmbassyCitizen::with(['user', 'area', 'occupation']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('passport_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $citizens = $query->latest()->paginate(15)->withQueryString();

        return view('admin.citizens.index', compact('citizens'));
    }

    public function create()
    {
        $areas = EmbassyArea::orderBy('name')->get();
        $occupations = EmbassyOccupation::orderBy('name')->get();

        return view('admin.citizens.create', compact('areas', 'occupations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'passport_number' => 'nullable|string|max:50',
            'residence_card_number' => 'nullable|string|max:50',
            'address' => 'required|string',
            'area_id' => 'nullable|exists:embassy_areas,id',
            'occupation_id' => 'nullable|exists:embassy_occupations,id',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'marital_status' => 'in:single,married,divorced,widowed',
        ]);

        $user = User::create([
            'name' => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('client');

        EmbassyCitizen::create(array_merge($validated, [
            'user_id' => $user->id,
            'nationality' => 'Bangladeshi',
        ]));

        return redirect()->route('admin.citizens.index')->with('success', 'Citizen registered successfully.');
    }

    public function show($id)
    {
        $citizen = EmbassyCitizen::with(['user', 'area', 'occupation', 'appointments', 'passports', 'consulars'])
            ->findOrFail($id);

        return view('admin.citizens.show', compact('citizen'));
    }
}
