<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmbassyContent;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = EmbassyContent::with('author')->latest()->paginate(15);

        return view('admin.contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.contents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:embassy_contents'],
            'body' => ['required', 'string'],
            'meta_description' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string'],
            'is_published' => ['boolean'],
        ]);

        $validated['created_by'] = auth()->id();
        $validated['is_published'] = $request->boolean('is_published');

        EmbassyContent::create($validated);

        return redirect()->route('admin.contents.index')->with('success', 'Content created successfully.');
    }

    public function edit(EmbassyContent $content)
    {
        return view('admin.contents.edit', compact('content'));
    }

    public function update(Request $request, EmbassyContent $content)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:embassy_contents,slug,' . $content->id],
            'body' => ['required', 'string'],
            'meta_description' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string'],
            'is_published' => ['boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        $content->update($validated);

        return redirect()->route('admin.contents.index')->with('success', 'Content updated successfully.');
    }

    public function destroy(EmbassyContent $content)
    {
        $content->delete();

        return redirect()->route('admin.contents.index')->with('success', 'Content deleted successfully.');
    }
}
