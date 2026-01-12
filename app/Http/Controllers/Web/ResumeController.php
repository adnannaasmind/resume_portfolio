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
    ) {
    }

    public function index(Request $request)
    {
        $resumes = $request->user()->resumes()->with('template')->latest()->paginate(10);
        return view('resumes.index', compact('resumes'));
    }

    public function create()
    {
        $templates = ResumeTemplate::orderBy('is_premium')->orderBy('name')->get();
        return view('resumes.create', compact('templates'));
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

        return redirect()->route('resumes.edit', $resume)->with('status', 'Resume created.');
    }

    public function edit(Resume $resume)
    {
        $this->authorizeUser($resume);
        $templates = ResumeTemplate::orderBy('is_premium')->orderBy('name')->get();
        return view('resumes.edit', compact('resume', 'templates'));
    }

    public function update(Request $request, Resume $resume)
    {
        $this->authorizeUser($resume);
        $data = $this->validateData($request, true);

        $resume->fill($data);
        $resume->completeness_score = $this->completenessService->calculate($data['data'] ?? $resume->data);
        $resume->save();

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
        return $request->validate([
            'resume_template_id' => ['nullable', 'exists:resume_templates,id'],
            'title' => [$update ? 'sometimes' : 'required', 'string', 'max:255'],
            'data' => ['nullable', 'array'],
            'language' => ['nullable', 'in:en,es'],
            'status' => ['nullable', 'in:draft,published'],
        ]);
    }

    protected function authorizeUser(Resume $resume): void
    {
        abort_unless(auth()->id() === $resume->user_id, 403);
    }

    protected function shouldApplyWatermark($user): bool
    {
        $subscription = $user->activeSubscription();
        if (!$subscription || $subscription->status !== 'active') {
            return true;
        }
        return false;
    }
}
