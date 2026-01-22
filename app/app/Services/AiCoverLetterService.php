<?php

namespace App\Services;

use App\Models\AIRequest;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Str;
use OpenAI\Exceptions\ErrorException;

class AiCoverLetterService
{
    public function generate(User $user, Resume $resume, string $jobDescription): array
    {
        $resumeSummary = data_get($resume->data, 'summary', '');
        $experiences = collect(data_get($resume->data, 'experience', []))
            ->take(3)
            ->map(fn ($exp) => sprintf('%s at %s', $exp['title'] ?? '', $exp['company'] ?? ''))
            ->filter()
            ->implode('; ');

        $prompt = sprintf(
            "Using the following resume summary and experience, craft a concise, professional cover letter tailored to the job description.\n\nResume summary: %s\nExperience: %s\n\nJob Description:\n%s",
            $resumeSummary,
            $experiences,
            $jobDescription
        );

        $apiKey = config('services.openai.key');
        $model = config('services.openai.model', 'gpt-4o-mini');

        $resultText = 'AI cover letter generation is not configured yet. Please add an OPENAI_API_KEY.';
        $tokens = 0;

        if ($apiKey) {
            try {
                $client = \OpenAI::client($apiKey);
                $result = $client->responses()->create([
                    'model' => $model,
                    'input' => $prompt,
                ]);

                $resultText = trim(
                    collect($result->output ?? [])
                        ->pluck('content')
                        ->flatten(1)
                        ->pluck('text')
                        ->filter()
                        ->implode("\n")
                );

                $tokens = (int) ($result->usage->total_tokens ?? 0);
            } catch (ErrorException $exception) {
                $resultText = 'AI request failed: '.$exception->getMessage();
            }
        }

        AIRequest::create([
            'user_id' => $user->id,
            'type' => 'cover_letter',
            'prompt' => Str::limit($jobDescription, 500),
            'response' => ['text' => $resultText],
            'tokens_used' => $tokens,
            'provider' => $apiKey ? 'openai' : 'placeholder',
            'metadata' => [
                'resume_id' => $resume->id,
                'model' => $model,
            ],
        ]);

        return [
            'cover_letter' => $resultText,
            'tokens_used' => $tokens,
        ];
    }
}
