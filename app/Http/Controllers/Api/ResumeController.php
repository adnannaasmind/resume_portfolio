<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Models\User;
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
        return $request->user()
            ->resumes()
            ->with('template')
            ->latest()
            ->paginate();
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $user = $request->user();

        $resume = $user->resumes()->create([
            ...$data,
            'slug' => Str::slug($data['title'].'-'.Str::random(6)),
            'share_token' => (string) Str::uuid(),
            'completeness_score' => $this->completenessService->calculate($data['data'] ?? []),
            'watermark_enabled' => true,
        ]);

        return response()->json($resume->load('template'), 201);
    }

    public function show(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        return $resume->load('template');
    }

    public function update(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        $data = $this->validateData($request, update: true);

        if (isset($data['title'])) {
            $resume->title = $data['title'];
        }

        $resume->fill($data);
        $resume->completeness_score = $this->completenessService->calculate($data['data'] ?? $resume->data);
        $resume->save();

        return $resume->refresh()->load('template');
    }

    public function destroy(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);
        $resume->delete();

        return response()->noContent();
    }

    public function duplicate(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        $copy = $resume->duplicate();

        return response()->json($copy->load('template'), 201);
    }

    public function publish(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        $resume->update([
            'is_public' => true,
            'share_token' => (string) Str::uuid(),
        ]);

        return response()->json([
            'share_url' => route('share.resume', ['token' => $resume->share_token], false),
            'token' => $resume->share_token,
        ]);
    }

    public function unpublish(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);
        $resume->update(['is_public' => false]);

        return response()->json(['message' => 'Resume unpublished']);
    }

    public function exportPdf(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        $watermark = $this->shouldApplyWatermark($request->user());
        $path = $this->pdfExportService->generate($resume, $watermark);

        $resume->update([
            'pdf_path' => $path,
            'last_exported_at' => now(),
            'watermark_enabled' => $watermark,
        ]);

        return response()->json([
            'path' => $path,
            'url' => asset('storage/'.$path),
        ]);
    }

    public function completeness(Request $request, Resume $resume)
    {
        $this->authorizeResume($request->user()->id, $resume);

        return response()->json([
            'score' => $this->completenessService->calculate($resume->data ?? []),
        ]);
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

    protected function authorizeResume(int $userId, Resume $resume): void
    {
        if ($resume->user_id !== $userId) {
            abort(403);
        }
    }

    protected function shouldApplyWatermark(User $user): bool
    {
        $subscription = $user->activeSubscription();

        if (! $subscription || $subscription->status !== 'active') {
            return true;
        }

        return false;
    }
}
