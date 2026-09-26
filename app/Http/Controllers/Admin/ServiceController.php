<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = EmbassyService::latest()->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function show($id)
    {
        $service = EmbassyService::findOrFail($id);

        return view('admin.services.show', compact('service'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:embassy_services'],
            'description' => ['nullable', 'string'],
            'fee' => ['required', 'numeric', 'min:0'],
            'category' => ['nullable', 'string', 'max:255'],
            'required_documents' => ['nullable', 'string'],
            'estimated_days' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['required_documents'] = array_filter(array_map('trim', explode("\n", $request->input('required_documents', ''))));

        EmbassyService::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit($id)
    {
        $service = EmbassyService::findOrFail($id);

        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = EmbassyService::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:embassy_services,slug,' . $service->id],
            'description' => ['nullable', 'string'],
            'fee' => ['required', 'numeric', 'min:0'],
            'category' => ['nullable', 'string', 'max:255'],
            'required_documents' => ['nullable', 'string'],
            'estimated_days' => ['nullable', 'integer', 'min:1'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['required_documents'] = array_filter(array_map('trim', explode("\n", $request->input('required_documents', ''))));

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy($id)
    {
        $service = EmbassyService::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
