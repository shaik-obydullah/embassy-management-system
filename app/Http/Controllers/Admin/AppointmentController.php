<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyAppointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = EmbassyAppointment::with(['citizen', 'service', 'slot']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($dateFrom = $request->input('date_from')) {
            $query->whereHas('slot', function ($q) use ($dateFrom) {
                $q->where('date', '>=', $dateFrom);
            });
        }

        if ($dateTo = $request->input('date_to')) {
            $query->whereHas('slot', function ($q) use ($dateTo) {
                $q->where('date', '<=', $dateTo);
            });
        }

        $appointments = $query->latest()->paginate(15)->withQueryString();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function show($id)
    {
        $appointment = EmbassyAppointment::with(['citizen', 'service', 'slot', 'user'])
            ->findOrFail($id);

        return view('admin.appointments.show', compact('appointment'));
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = EmbassyAppointment::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'in:pending,confirmed,completed,cancelled'],
        ]);

        $appointment->update($validated);

        return back()->with('success', 'Appointment status updated successfully.');
    }
}
