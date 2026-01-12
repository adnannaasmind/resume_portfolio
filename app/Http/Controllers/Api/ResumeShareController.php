<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resume;

class ResumeShareController extends Controller
{
    public function show(string $token)
    {
        $resume = Resume::query()
            ->where('share_token', $token)
            ->where('is_public', true)
            ->with(['template', 'user:id,name'])
            ->firstOrFail();

        return response()->json($resume);
    }
}
