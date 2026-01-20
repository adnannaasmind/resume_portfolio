<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resume;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ResumeTemplate;
use App\Traits\HasDummyResume;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class TemplateController extends Controller
{
    use HasDummyResume;

    public function index(): View
    {
        $templates = ResumeTemplate::withCount('resumes')->latest()->paginate(20);

        // Get current user's resume template IDs to show which templates they've already used
        $userResumeTemplateIds = Resume::where('user_id', auth()->id())
            ->pluck('resume_template_id')
            ->toArray();

        return view('admin.resume_templates.index', compact('templates', 'userResumeTemplateIds'));
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
        $validated['slug'] = Str::slug($validated['name']);

        ResumeTemplate::create($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template created successfully');
    }

    public function show(ResumeTemplate $template): View
    {
        $template->loadCount('resumes');

        // Get demo resume for this template
        $resume = Resume::where('resume_template_id', $template->id)
            ->with(['user', 'user.userProfile', 'experiences', 'educations', 'skills', 'projects', 'achievements', 'passions', 'highlights'])
            ->first();

        // If no demo resume exists, create a dummy one with sample data
        if (!$resume) {
            $resume = $this->getDummyResume($template->id);
        }

        // Render the specific template blade file
        if ($template->blade_file) {
            return view($template->blade_file, compact('resume', 'template'));
        }

        // Fallback to default view
        return view('admin.resume_templates.show', compact('template'));
    }

    public function edit(ResumeTemplate $template)
    {
        // Get demo resume for preview
        $resume = Resume::where('resume_template_id', $template->id)
            ->with(['user', 'user.userProfile', 'experiences', 'educations', 'skills', 'projects', 'achievements', 'passions', 'highlights'])
            ->first();

        $isRealResume = $resume !== null;

        if (!$resume) {
            $resume = $this->getDummyResume($template->id);
        }

        // Render the template with edit controls (only if real resume exists)
        if ($template->blade_file) {
            return view($template->blade_file, [
                'template' => $template,
                'resume' => $resume,
                'isEditMode' => $isRealResume, // Only enable edit mode for real resumes
            ]);
        }

        return view('admin.resume_templates.edit', compact('template', 'resume'));
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
        $validated['slug'] = Str::slug($validated['name']);

        $template->update($validated);

        return redirect()->route('admin.templates.index')
            ->with('success', 'Template updated successfully');
    }

    public function preview(ResumeTemplate $template): View
    {
        // Get demo resume for this template
        $resume = Resume::where('resume_template_id', $template->id)
            ->with(['user', 'user.userProfile', 'experiences', 'educations', 'skills', 'projects', 'achievements', 'passions', 'highlights'])
            ->first();

        // If no demo resume exists, create a dummy one with sample data
        if (!$resume) {
            $resume = $this->getDummyResume($template->id);
        }

        // Render the template blade file
        if ($template->blade_file) {
            return view($template->blade_file, compact('resume'));
        }

        // Fallback if no blade file
        return view('admin.resume_templates.template_free', compact('resume'));
    }

    public function useTemplate(Request $request, ResumeTemplate $template): RedirectResponse
    {
        $user = auth()->user();

        // Check if user already has a resume with this template
        $existingResume = Resume::where('user_id', $user->id)
            ->where('resume_template_id', $template->id)
            ->first();

        // If resume exists, redirect to edit it instead of creating new one
        if ($existingResume) {
            return redirect()->route('admin.resumes.edit', $existingResume)
                ->with('info', 'You already have a resume with this template. Continue editing your existing resume.');
        }

        // Validate title input from modal
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        // Create new resume for authenticated user with the provided title
        $resume = Resume::create([
            'user_id' => $user->id,
            'resume_template_id' => $template->id,
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title'] . '-' . $user->id . '-' . time()),
            'data' => [
                'summary' => 'Add your professional summary here...',
            ],
            'is_public' => false,
            'share_token' => Str::random(32),
            'completeness_score' => 0,
            'status' => 'draft',
            'language' => 'en',
        ]);

        return redirect()->route('admin.resumes.edit', $resume)
            ->with('success', 'Resume "' . $validated['title'] . '" created successfully! Start adding your information.');
    }
}
