<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()
            ->portfolios()
            ->latest()
            ->paginate();
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $portfolio = $request->user()->portfolios()->create([
            ...$data,
            'slug' => Str::slug($data['title'].'-'.Str::random(6)),
        ]);

        return response()->json($portfolio, 201);
    }

    public function show(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($request->user()->id, $portfolio);

        return $portfolio;
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($request->user()->id, $portfolio);

        $data = $this->validateData($request, update: true);
        $portfolio->update($data);

        return $portfolio->refresh();
    }

    public function destroy(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($request->user()->id, $portfolio);
        $portfolio->delete();

        return response()->noContent();
    }

    public function publish(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($request->user()->id, $portfolio);

        $portfolio->update([
            'is_public' => true,
            'published_at' => now(),
        ]);

        return response()->json([
            'public_url' => url("/api/v1/portfolios/public/{$portfolio->slug}"),
        ]);
    }

    public function unpublish(Request $request, Portfolio $portfolio)
    {
        $this->authorizePortfolio($request->user()->id, $portfolio);
        $portfolio->update(['is_public' => false]);

        return response()->json(['message' => 'Portfolio unpublished.']);
    }

    protected function validateData(Request $request, bool $update = false): array
    {
        return $request->validate([
            'title' => [$update ? 'sometimes' : 'required', 'string', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'summary' => ['nullable', 'string'],
            'content' => ['nullable', 'array'],
            'projects' => ['nullable', 'array'],
            'cta' => ['nullable', 'array'],
            'social_links' => ['nullable', 'array'],
            'template' => ['nullable', 'string', 'max:50'],
            'language' => ['nullable', 'in:en,es'],
            'theme' => ['nullable', 'array'],
        ]);
    }

    protected function authorizePortfolio(int $userId, Portfolio $portfolio): void
    {
        if ($portfolio->user_id !== $userId) {
            abort(403);
        }
    }
}
