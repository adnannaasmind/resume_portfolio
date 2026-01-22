<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResumeTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TemplateController extends Controller
{
    public function index()
    {
        return ResumeTemplate::orderByDesc('updated_at')->paginate();
    }

    public function store(Request $request)
    {
        $data = $this->validateTemplate($request);
        $template = ResumeTemplate::create($data + [
            'slug' => Str::slug($data['name'].'-'.Str::random(4)),
        ]);

        return response()->json($template, 201);
    }

    public function show(ResumeTemplate $template)
    {
        return $template;
    }

    public function update(Request $request, ResumeTemplate $template)
    {
        $data = $this->validateTemplate($request, true);
        $template->update($data);

        return $template;
    }

    public function destroy(ResumeTemplate $template)
    {
        $template->delete();

        return response()->noContent();
    }

    protected function validateTemplate(Request $request, bool $update = false): array
    {
        return $request->validate([
            'name' => [$update ? 'sometimes' : 'required', 'string', 'max:255'],
            'preview_url' => ['nullable', 'string', 'max:500'],
            'cover_image' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'is_premium' => ['nullable', 'boolean'],
            'metadata' => ['nullable', 'array'],
            'category' => ['nullable', 'string', 'max:100'],
            'locale' => ['nullable', 'in:en,es'],
        ]);
    }
}
