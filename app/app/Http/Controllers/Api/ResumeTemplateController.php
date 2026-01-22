<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ResumeTemplate;

class ResumeTemplateController extends Controller
{
    public function index()
    {
        $templates = ResumeTemplate::query()
            ->select('id', 'name', 'slug', 'is_premium', 'preview_url', 'cover_image', 'description', 'category')
            ->orderBy('is_premium')
            ->orderBy('name')
            ->get();

        return response()->json($templates);
    }
}
