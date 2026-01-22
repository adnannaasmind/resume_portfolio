<?php

namespace App\Services;

use App\Models\Resume;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PdfExportService
{
    public function generate(Resume $resume, bool $watermark = true): string
    {
        $payload = [
            'resume' => $resume,
            'data' => $resume->data ?? [],
            'template' => $resume->template,
            'watermark' => $watermark,
            'watermarkText' => config('services.watermark.text'),
        ];

        $pdf = Pdf::loadView('resumes.pdf', $payload)->setPaper('A4');

        $path = sprintf('resumes/%s-%s.pdf', $resume->id, now()->timestamp);

        Storage::disk('public')->put($path, $pdf->output());

        return $path;
    }
}
