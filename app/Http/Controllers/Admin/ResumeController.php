<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\ResumeAchievement;
use App\Models\ResumeEducation;
use App\Models\ResumeExperience;
use App\Models\ResumeHighlight;
use App\Models\ResumePassion;
use App\Models\ResumeProject;
use App\Models\ResumeSkill;
use App\Models\ResumeTemplate;
use App\Models\User;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        // Show only authenticated user's resumes
        $resumes = Resume::where('user_id', auth()->id())
            ->with(['user', 'template'])
            ->latest()
            ->paginate(20);

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
        $resume->load(['user', 'user.userProfile', 'template', 'experiences', 'educations', 'skills', 'projects', 'achievements', 'passions', 'highlights']);

        // If template has blade_file specified, use that, otherwise use default
        if ($resume->template && $resume->template->blade_file) {
            return view($resume->template->blade_file, compact('resume'));
        }

        // Fallback to default template
        return view('admin.resumes.show', compact('resume'));
    }

    public function edit(Resume $resume)
    {
        $resume->load(['user', 'user.userProfile', 'template', 'experiences', 'educations', 'skills', 'projects', 'achievements', 'passions', 'highlights']);

        // If template has blade_file, render that template for editing
        if ($resume->template && $resume->template->blade_file) {
            return view($resume->template->blade_file, [
                'resume' => $resume,
                'template' => $resume->template,
                'isEditMode' => true
            ]);
        }

        // Fallback to default edit form
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
        try {
            // Check if user owns this resume
            if ($resume->user_id !== auth()->id()) {
                \Log::warning('Unauthorized delete attempt', [
                    'resume_id' => $resume->id,
                    'owner_id' => $resume->user_id,
                    'attempted_by' => auth()->id()
                ]);

                if (request()->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'You do not have permission to delete this resume'
                    ], 403);
                }

                return redirect()->route('admin.resumes.index')
                    ->with('error', 'You do not have permission to delete this resume');
            }

            \Log::info('Starting resume deletion', [
                'resume_id' => $resume->id,
                'user_id' => auth()->id(),
                'title' => $resume->title
            ]);

            // Delete profile image if exists
            $data = $resume->data ?? [];
            if (!empty($data['profile_image'])) {
                $imagePath = $data['profile_image'];
                if (\Storage::disk('public')->exists($imagePath)) {
                    \Storage::disk('public')->delete($imagePath);
                    \Log::info('Profile image deleted', ['path' => $imagePath]);
                }
            }

            // Store resume ID before deletion
            $resumeId = $resume->id;
            $resumeTitle = $resume->title;

            // Delete all related records
            $resume->experiences()->delete();
            \Log::info('Experiences deleted', ['resume_id' => $resumeId]);

            $resume->educations()->delete();
            \Log::info('Educations deleted', ['resume_id' => $resumeId]);

            $resume->skills()->delete();
            \Log::info('Skills deleted', ['resume_id' => $resumeId]);

            $resume->projects()->delete();
            \Log::info('Projects deleted', ['resume_id' => $resumeId]);

            // Delete the resume
            $resume->delete();

            \Log::info('Resume deleted successfully', [
                'resume_id' => $resumeId,
                'title' => $resumeTitle
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Resume deleted successfully'
                ]);
            }

            return redirect()->route('admin.resumes.index')
                ->with('success', 'Resume "' . $resumeTitle . '" deleted successfully');
        } catch (\Exception $e) {
            \Log::error('Error deleting resume', [
                'resume_id' => $resume->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete resume: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('admin.resumes.index')
                ->with('error', 'Failed to delete resume: ' . $e->getMessage());
        }
    }

    // Experience Methods
    public function storeExperience(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $resume->experiences()->create($validated);

        return response()->json(['success' => true, 'message' => 'Experience added successfully']);
    }

    public function updateExperience(Request $request, Resume $resume, ResumeExperience $experience)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'is_current' => 'boolean',
            'description' => 'nullable|string',
        ]);

        $experience->update($validated);

        return response()->json(['success' => true, 'message' => 'Experience updated successfully']);
    }

    public function deleteExperience(Resume $resume, ResumeExperience $experience)
    {
        $experience->delete();

        return response()->json(['success' => true, 'message' => 'Experience deleted successfully']);
    }

    // Education Methods
    public function storeEducation(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $resume->educations()->create($validated);

        return response()->json(['success' => true, 'message' => 'Education added successfully']);
    }

    public function updateEducation(Request $request, Resume $resume, ResumeEducation $education)
    {
        $validated = $request->validate([
            'degree' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return response()->json(['success' => true, 'message' => 'Education updated successfully']);
    }

    public function deleteEducation(Resume $resume, ResumeEducation $education)
    {
        $education->delete();

        return response()->json(['success' => true, 'message' => 'Education deleted successfully']);
    }

    // Skill Methods
    public function storeSkill(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
        ]);

        $resume->skills()->create($validated);

        return response()->json(['success' => true, 'message' => 'Skill added successfully']);
    }

    public function updateSkill(Request $request, Resume $resume, ResumeSkill $skill)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'nullable|string|max:50',
        ]);

        $skill->update($validated);

        return response()->json(['success' => true, 'message' => 'Skill updated successfully']);
    }

    public function deleteSkill(Resume $resume, ResumeSkill $skill)
    {
        $skill->delete();

        return response()->json(['success' => true, 'message' => 'Skill deleted successfully']);
    }

    // Project Methods
    public function storeProject(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'role' => 'nullable|string|max:255',
        ]);

        $resume->projects()->create($validated);

        return response()->json(['success' => true, 'message' => 'Project added successfully']);
    }

    public function updateProject(Request $request, Resume $resume, ResumeProject $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'role' => 'nullable|string|max:255',
        ]);

        $project->update($validated);

        return response()->json(['success' => true, 'message' => 'Project updated successfully']);
    }

    public function deleteProject(Resume $resume, ResumeProject $project)
    {
        $project->delete();

        return response()->json(['success' => true, 'message' => 'Project deleted successfully']);
    }

    // Contact Update Method
    public function updateContact(Request $request, Resume $resume)
    {
        try {
            $validated = $request->validate([
                'phone' => 'nullable|string|max:50',
                'email' => 'required|email|max:255',
                'location' => 'nullable|string|max:255',
            ]);

            // Update user email
            $resume->user->update(['email' => $validated['email']]);

            // Update or create user profile
            if (!$resume->user->userProfile) {
                $resume->user->userProfile()->create([
                    'phone' => $validated['phone'],
                    'location' => $validated['location'],
                ]);
            } else {
                $resume->user->userProfile->update([
                    'phone' => $validated['phone'],
                    'location' => $validated['location'],
                ]);
            }

            return response()->json(['success' => true, 'message' => 'Contact information updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // About/Summary Update Method
    public function updateAbout(Request $request, Resume $resume)
    {
        try {
            \Log::info('Update About called', [
                'resume_id' => $resume->id,
                'user_id' => auth()->id(),
                'data' => $request->all()
            ]);

            $validated = $request->validate([
                'summary' => 'nullable|string',
            ]);

            // Update resume data
            $data = $resume->data ?? [];
            $data['summary'] = $validated['summary'];
            $resume->update(['data' => $data]);

            // Also update user profile summary
            $resume->user->userProfile()->updateOrCreate(
                ['user_id' => $resume->user->id],
                ['summary' => $validated['summary']]
            );

            \Log::info('About Me updated successfully');

            return response()->json(['success' => true, 'message' => 'Summary updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating About Me: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Profile Update Method (Name and Job Title)
    public function updateProfile(Request $request, Resume $resume)
    {
        try {
            \Log::info('Update Profile called', [
                'resume_id' => $resume->id,
                'user_id' => auth()->id(),
                'data' => $request->all()
            ]);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'title' => 'required|string|max:255',
            ]);

            // Update user name
            $resume->user->update(['name' => $validated['name']]);

            // Update resume title
            $resume->update(['title' => $validated['title']]);

            \Log::info('Profile updated successfully');

            return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
        } catch (\Exception $e) {
            \Log::error('Error updating Profile: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Profile Image Update Method
    public function updateProfileImage(Request $request, Resume $resume)
    {
        try {
            \Log::info('Update Profile Image called', [
                'resume_id' => $resume->id,
                'user_id' => auth()->id(),
                'has_file' => $request->hasFile('profile_image'),
                'remove_image' => $request->input('remove_image')
            ]);

            // Check if user wants to remove the image
            if ($request->input('remove_image') == '1') {
                $data = $resume->data ?? [];

                // Delete old image file if exists
                if (!empty($data['profile_image'])) {
                    \Storage::disk('public')->delete($data['profile_image']);
                }

                // Remove profile_image from data
                unset($data['profile_image']);
                $resume->update(['data' => $data]);

                \Log::info('Profile image removed successfully');
                return response()->json(['success' => true, 'message' => 'Profile image removed successfully']);
            }

            // Validate image upload
            $request->validate([
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get current data
            $data = $resume->data ?? [];

            // Delete old image if exists
            if (!empty($data['profile_image'])) {
                \Storage::disk('public')->delete($data['profile_image']);
            }

            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');

            // Update resume data
            $data['profile_image'] = $imagePath;
            $resume->update(['data' => $data]);

            \Log::info('Profile image updated successfully', ['path' => $imagePath]);

            return response()->json([
                'success' => true,
                'message' => 'Profile image updated successfully',
                'image_path' => $imagePath
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error updating profile image', [
                'errors' => $e->errors()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Error updating profile image: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Reference Methods (if you have a ResumeReference model)
    public function storeReference(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        // Store in resume data array for now
        $data = $resume->data ?? [];
        $references = $data['references'] ?? [];
        $references[] = array_merge($validated, ['id' => count($references) + 1]);
        $data['references'] = $references;
        $resume->update(['data' => $data]);

        return response()->json(['success' => true, 'message' => 'Reference added successfully']);
    }

    public function updateReference(Request $request, Resume $resume, $referenceId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
        ]);

        $data = $resume->data ?? [];
        $references = $data['references'] ?? [];

        foreach ($references as $key => $ref) {
            if ($ref['id'] == $referenceId) {
                $references[$key] = array_merge($validated, ['id' => $referenceId]);
                break;
            }
        }

        $data['references'] = $references;
        $resume->update(['data' => $data]);

        return response()->json(['success' => true, 'message' => 'Reference updated successfully']);
    }

    public function deleteReference(Resume $resume, $referenceId)
    {
        $data = $resume->data ?? [];
        $references = $data['references'] ?? [];

        $references = array_filter($references, function ($ref) use ($referenceId) {
            return $ref['id'] != $referenceId;
        });

        $data['references'] = array_values($references);
        $resume->update(['data' => $data]);

        return response()->json(['success' => true, 'message' => 'Reference deleted successfully']);
    }

    // Achievement Methods
    public function storeAchievement(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'issuer' => 'nullable|string|max:255',
        ]);

        $resume->achievements()->create($validated);

        return response()->json(['success' => true, 'message' => 'Achievement added successfully']);
    }

    public function updateAchievement(Request $request, Resume $resume, ResumeAchievement $achievement)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'nullable|date',
            'issuer' => 'nullable|string|max:255',
        ]);

        $achievement->update($validated);

        return response()->json(['success' => true, 'message' => 'Achievement updated successfully']);
    }

    public function deleteAchievement(Resume $resume, ResumeAchievement $achievement)
    {
        $achievement->delete();

        return response()->json(['success' => true, 'message' => 'Achievement deleted successfully']);
    }

    // Passion Methods
    public function storePassion(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
        ]);

        $resume->passions()->create($validated);

        return response()->json(['success' => true, 'message' => 'Passion added successfully']);
    }

    public function updatePassion(Request $request, Resume $resume, ResumePassion $passion)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
        ]);

        $passion->update($validated);

        return response()->json(['success' => true, 'message' => 'Passion updated successfully']);
    }

    public function deletePassion(Resume $resume, ResumePassion $passion)
    {
        $passion->delete();

        return response()->json(['success' => true, 'message' => 'Passion deleted successfully']);
    }

    // Highlight Methods
    public function storeHighlight(Request $request, Resume $resume)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $resume->highlights()->create($validated);

        return response()->json(['success' => true, 'message' => 'Highlight added successfully']);
    }

    public function updateHighlight(Request $request, Resume $resume, ResumeHighlight $highlight)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $highlight->update($validated);

        return response()->json(['success' => true, 'message' => 'Highlight updated successfully']);
    }

    public function deleteHighlight(Resume $resume, ResumeHighlight $highlight)
    {
        $highlight->delete();

        return response()->json(['success' => true, 'message' => 'Highlight deleted successfully']);
    }
}
