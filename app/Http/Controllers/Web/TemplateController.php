<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ResumeTemplate;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = ResumeTemplate::orderBy('is_premium')->orderBy('name')->get();
        return view('templates.index', compact('templates'));
    }
}
