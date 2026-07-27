<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\EmbassyAppointment;
use App\Models\EmbassyAppointmentSlot;
use App\Models\EmbassyService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = auth()->user()->appointments()
            ->with(['service', 'slot'])
            ->latest()
            ->paginate(15);

        return view('client.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $services = EmbassyService::where('is_active', true)->get();
        $slots = EmbassyAppointmentSlot::where('is_active', true)
            ->where('date', '>=', now()->toDateString())
            ->get();

        return view('client.appointments.create', compact('services', 'slots'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => ['required', 'exists:embassy_services,id'],
            'slot_id' => ['required', 'exists:embassy_appointment_slots,id'],
            'notes' => ['nullable', 'string'],
        ]);

        $referenceNumber = 'EMB-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));

        auth()->user()->appointments()->create([
            'citizen_id' => auth()->user()->citizen?->id,
            'service_id' => $validated['service_id'],
            'slot_id' => $validated['slot_id'],
            'reference_number' => $referenceNumber,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('client.appointments.index')->with('success', 'Appointment booked successfully. Reference: ' . $referenceNumber);
    }
}
