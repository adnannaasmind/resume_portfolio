<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\ResumeTemplate;
use App\Services\PdfExportService;
use App\Services\ResumeCompletenessService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResumeController extends Controller
{
    public function __construct(
        protected ResumeCompletenessService $completenessService,
        protected PdfExportService $pdfExportService
    ) {}

    public function index(Request $request)
    {
        $resumes = $request->user()->resumes()->with('template')->latest()->paginate(10);

        return view('frontend.pages.resumes.index', compact('resumes'));
    }

    public function create()
    {
        $templates = ResumeTemplate::orderBy('is_premium')->orderBy('name')->get();

        return view('frontend.pages.resumes.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $resume = $request->user()->resumes()->create([
            ...$data,
            'slug' => Str::slug($data['title'].'-'.Str::random(6)),
            'share_token' => Str::uuid()->toString(),
            'completeness_score' => $this->completenessService->calculate($data['data'] ?? []),
            'watermark_enabled' => true,
        ]);

        $this->syncRelations($resume, $request);

        return redirect()->route('resumes.edit', $resume)->with('status', 'Resume created.');
    }

    public function edit(Resume $resume)
    {
        $this->authorizeUser($resume);
        $resume->load(['experiences', 'educations', 'skills', 'projects']);
        $templates = ResumeTemplate::orderBy('is_premium')->orderBy('name')->get();

        return view('frontend.pages.resumes.edit', compact('resume', 'templates'));
    }

    public function update(Request $request, Resume $resume)
    {
        $this->authorizeUser($resume);
        $data = $this->validateData($request, true);

        $resume->fill($data);
        $resume->completeness_score = $this->completenessService->calculate($data['data'] ?? $resume->data);
        $resume->save();

        $this->syncRelations($resume, $request);

        return redirect()->route('resumes.edit', $resume)->with('status', 'Resume updated.');
    }

    public function destroy(Resume $resume)
    {
        $this->authorizeUser($resume);
        $resume->delete();

        return redirect()->route('resumes.index')->with('status', 'Resume deleted.');
    }

    public function duplicate(Resume $resume)
    {
        $this->authorizeUser($resume);
        $copy = $resume->duplicate();

        return redirect()->route('resumes.edit', $copy)->with('status', 'Resume duplicated.');
    }

    public function publish(Resume $resume)
    {
        $this->authorizeUser($resume);
        $resume->update([
            'is_public' => true,
            'share_token' => Str::uuid()->toString(),
        ]);

        return back()->with('status', 'Resume published. Share link: '.route('resume.share', $resume->share_token));
    }

    public function unpublish(Resume $resume)
    {
        $this->authorizeUser($resume);
        $resume->update(['is_public' => false]);

        return back()->with('status', 'Resume unpublished.');
    }

    public function export(Resume $resume)
    {
        $this->authorizeUser($resume);
        $watermark = $this->shouldApplyWatermark($requestUser = $resume->user);
        $path = $this->pdfExportService->generate($resume, $watermark);
        $resume->update([
            'pdf_path' => $path,
            'last_exported_at' => now(),
            'watermark_enabled' => $watermark,
        ]);

        return back()->with('status', 'PDF exported: '.asset('storage/'.$path));
    }

    protected function validateData(Request $request, bool $update = false): array
    {
        $validated = $request->validate([
            'resume_template_id' => ['nullable', 'exists:resume_templates,id'],
            'title' => [$update ? 'sometimes' : 'required', 'string', 'max:255'],
            'data' => ['nullable', 'array'],
            'language' => ['nullable', 'in:en,es'],
            'status' => ['nullable', 'in:draft,published'],
        ]);

        if ($request->filled('data_raw')) {
            $decoded = json_decode($request->string('data_raw')->toString(), true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $validated['data'] = $decoded;
            }
        }

        if (isset($validated['data']['skills']) && is_string($validated['data']['skills'])) {
            $validated['data']['skills'] = array_filter(array_map('trim', explode(',', $validated['data']['skills'])));
        }

        if ($request->filled('summary') || $request->filled('skills')) {
            $validated['data'] = $validated['data'] ?? [];
            if ($request->filled('summary')) {
                $validated['data']['summary'] = $request->string('summary')->toString();
            }
            if ($request->filled('skills')) {
                $validated['data']['skills'] = array_filter(array_map('trim', explode(',', $request->string('skills')->toString())));
            }
        }

        if ($request->hasAny(['experiences', 'educations', 'projects'])) {
            $validated['data'] = $validated['data'] ?? [];

            $experienceData = [];
            foreach ($request->input('experiences', []) as $exp) {
                if (! empty($exp['company']) || ! empty($exp['title'])) {
                    $experienceData[] = [
                        'company' => $exp['company'] ?? null,
                        'title' => $exp['title'] ?? null,
                        'location' => $exp['location'] ?? null,
                        'start_date' => $exp['start_date'] ?? null,
                        'end_date' => $exp['end_date'] ?? null,
                        'description' => $exp['description'] ?? null,
                    ];
                }
            }
            if (! empty($experienceData)) {
                $validated['data']['experience'] = $experienceData;
            }

            $educationData = [];
            foreach ($request->input('educations', []) as $edu) {
                if (! empty($edu['institution']) || ! empty($edu['degree'])) {
                    $educationData[] = [
                        'institution' => $edu['institution'] ?? null,
                        'study_type' => $edu['degree'] ?? null,
                        'area' => $edu['field'] ?? null,
                        'start_date' => $edu['start_date'] ?? null,
                        'end_date' => $edu['end_date'] ?? null,
                        'description' => $edu['description'] ?? null,
                    ];
                }
            }
            if (! empty($educationData)) {
                $validated['data']['education'] = $educationData;
            }

            $projectData = [];
            foreach ($request->input('projects', []) as $project) {
                if (! empty($project['name'])) {
                    $projectData[] = [
                        'name' => $project['name'],
                        'role' => $project['role'] ?? null,
                        'url' => $project['url'] ?? null,
                        'description' => $project['description'] ?? null,
                    ];
                }
            }
            if (! empty($projectData)) {
                $validated['data']['projects'] = $projectData;
            }
        }

        return $validated;
    }

    protected function syncRelations(Resume $resume, Request $request): void
    {
        $resume->experiences()->delete();
        $resume->educations()->delete();
        $resume->skills()->delete();
        $resume->projects()->delete();

        foreach ($request->input('experiences', []) as $index => $exp) {
            if (! empty($exp['company']) || ! empty($exp['title'])) {
                $resume->experiences()->create([
                    'company' => $exp['company'] ?? null,
                    'title' => $exp['title'] ?? null,
                    'location' => $exp['location'] ?? null,
                    'start_date' => $exp['start_date'] ?? null,
                    'end_date' => $exp['end_date'] ?? null,
                    'is_current' => ! empty($exp['is_current']),
                    'description' => $exp['description'] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        foreach ($request->input('educations', []) as $index => $edu) {
            if (! empty($edu['institution']) || ! empty($edu['degree'])) {
                $resume->educations()->create([
                    'institution' => $edu['institution'] ?? null,
                    'degree' => $edu['degree'] ?? null,
                    'field' => $edu['field'] ?? null,
                    'start_date' => $edu['start_date'] ?? null,
                    'end_date' => $edu['end_date'] ?? null,
                    'description' => $edu['description'] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        foreach ($request->input('skill_items', []) as $index => $skill) {
            if (! empty($skill['name'])) {
                $resume->skills()->create([
                    'name' => $skill['name'],
                    'level' => $skill['level'] ?? null,
                    'category' => $skill['category'] ?? null,
                    'sort_order' => $index,
                ]);
            }
        }

        foreach ($request->input('projects', []) as $index => $project) {
            if (! empty($project['name'])) {
                $stack = $project['tech_stack'] ?? null;
                if (is_string($stack)) {
                    $stack = array_filter(array_map('trim', explode(',', $stack)));
                }
                $resume->projects()->create([
                    'name' => $project['name'],
                    'role' => $project['role'] ?? null,
                    'url' => $project['url'] ?? null,
                    'description' => $project['description'] ?? null,
                    'tech_stack' => $stack,
                    'sort_order' => $index,
                ]);
            }
        }
    }

    protected function authorizeUser(Resume $resume): void
    {
        abort_unless(auth()->id() === $resume->user_id, 403);
    }

    protected function shouldApplyWatermark($user): bool
    {
        $subscription = $user->activeSubscription();
        if (! $subscription || $subscription->status !== 'active') {
            return true;
        }

        return false;
    }
}
