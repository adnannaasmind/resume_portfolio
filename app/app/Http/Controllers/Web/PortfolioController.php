<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $portfolios = $request->user()->portfolios()->latest()->paginate(10);

        return view('frontend.pages.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('frontend.pages.portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $portfolio = $request->user()->portfolios()->create([
            ...$data,
            'slug' => Str::slug($data['title'].'-'.Str::random(6)),
        ]);

        return redirect()->route('portfolios.edit', $portfolio)->with('status', 'Portfolio created.');
    }

    public function edit(Portfolio $portfolio)
    {
        $this->authorizeUser($portfolio);

        return view('frontend.pages.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $this->authorizeUser($portfolio);
        $data = $this->validateData($request, true);
        $portfolio->update($data);

        return back()->with('status', 'Portfolio updated.');
    }

    public function destroy(Portfolio $portfolio)
    {
        $this->authorizeUser($portfolio);
        $portfolio->delete();

        return redirect()->route('portfolios.index')->with('status', 'Portfolio deleted.');
    }

    public function publish(Portfolio $portfolio)
    {
        $this->authorizeUser($portfolio);
        $portfolio->update([
            'is_public' => true,
            'published_at' => now(),
        ]);

        return back()->with('status', 'Portfolio published: '.route('portfolio.public', $portfolio->slug));
    }

    public function unpublish(Portfolio $portfolio)
    {
        $this->authorizeUser($portfolio);
        $portfolio->update(['is_public' => false]);

        return back()->with('status', 'Portfolio unpublished.');
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

    protected function authorizeUser(Portfolio $portfolio): void
    {
        abort_unless(auth()->id() === $portfolio->user_id, 403);
    }
}
