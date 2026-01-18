<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResumeTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TemplateController extends Controller
{
    public function index(): View
    {
        $templates = ResumeTemplate::withCount('resumes')->latest()->paginate(20);

        return view('admin.templates.index', compact('templates'));
    }

    public function create(): View
    {
        return view('admin.templates.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'metadata' => 'nullable|array',
            'preview_url' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_premium' => 'boolean',
        ]);

        // Set defaults
        $validated['is_premium'] = $request->boolean('is_premium', false);
        $validated['locale'] = $request->input('locale', 'en');
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        ResumeTemplate::create($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template created successfully');
    }

    public function show(ResumeTemplate $template): View
    {
        $template->loadCount('resumes');

        return view('admin.templates.show', compact('template'));
    }

    public function edit(ResumeTemplate $template): View
    {
        return view('admin.templates.edit', compact('template'));
    }

    public function update(Request $request, ResumeTemplate $template): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:100',
            'metadata' => 'nullable|array',
            'preview_url' => 'nullable|string',
            'cover_image' => 'nullable|string',
            'is_premium' => 'boolean',
        ]);

        $validated['is_premium'] = $request->boolean('is_premium', $template->is_premium);
        $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);

        $template->update($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template updated successfully');
    }

    public function destroy(ResumeTemplate $template): RedirectResponse
    {
        $template->delete();

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template deleted successfully');
    }
}
