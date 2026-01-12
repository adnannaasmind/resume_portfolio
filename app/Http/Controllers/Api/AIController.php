<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resume;
use App\Services\AiCoverLetterService;
use Illuminate\Http\Request;

class AIController extends Controller
{
    public function __construct(protected AiCoverLetterService $service)
    {
    }

    public function generateCoverLetter(Request $request)
    {
        $data = $request->validate([
            'resume_id' => ['required', 'exists:resumes,id'],
            'job_description' => ['required', 'string', 'min:50'],
        ]);

        $resume = Resume::where('id', $data['resume_id'])
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $result = $this->service->generate($request->user(), $resume, $data['job_description']);

        return response()->json($result);
    }
}
