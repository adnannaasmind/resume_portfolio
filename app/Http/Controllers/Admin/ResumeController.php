<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\ResumeTemplate;
use App\Models\User;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $resumes = Resume::with(['user', 'template'])->latest()->paginate(20);
        return view('admin.resumes.index', compact('resumes'));
    }

    public function create()
    {
        $templates = ResumeTemplate::all();
        $users = User::all();
        return view('admin.resumes.create', compact('templates', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'resume_template_id' => 'required|exists:resume_templates,id',
            'title' => 'required|string|max:255',
            'data' => 'nullable|array',
        ]);

        Resume::create($validated);

        return redirect()->route('admin.resumes.index')
            ->with('success', 'Resume created successfully');
    }

    public function show(Resume $resume)
    {
        $resume->load(['user', 'template']);
        return view('admin.resumes.show', compact('resume'));
    }

    public function edit(Resume $resume)
    {
        $templates = ResumeTemplate::all();
        $users = User::all();
        return view('admin.resumes.edit', compact('resume', 'templates', 'users'));
    }

    public function update(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'resume_template_id' => 'required|exists:resume_templates,id',
            'title' => 'required|string|max:255',
            'data' => 'nullable|array',
        ]);

        $resume->update($validated);

        return redirect()->route('admin.resumes.index')
            ->with('success', 'Resume updated successfully');
    }

    public function destroy(Resume $resume)
    {
        $resume->delete();
        return redirect()->route('admin.resumes.index')
            ->with('success', 'Resume deleted successfully');
    }
}
