<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('user')->latest()->paginate(20);

        return view('admin.portfolio-templates.index', compact('portfolios'));
    }

    public function create()
    {
        $users = User::all();

        return view('admin.portfolio-templates.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        Portfolio::create($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio created successfully');
    }

    public function show(Portfolio $portfolio)
    {
        $portfolio->load('user');

        return view('admin.portfolio-templates.show', compact('portfolio'));
    }

    public function edit(Portfolio $portfolio)
    {
        $users = User::all();

        return view('admin.portfolio-templates.edit', compact('portfolio', 'users'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        $portfolio->update($validated);

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio updated successfully');
    }

    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();

        return redirect()->route('admin.portfolios.index')
            ->with('success', 'Portfolio deleted successfully');
    }
}
