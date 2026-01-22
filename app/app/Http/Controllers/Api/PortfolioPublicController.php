<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;

class PortfolioPublicController extends Controller
{
    public function show(string $slug)
    {
        $portfolio = Portfolio::query()
            ->where('slug', $slug)
            ->where('is_public', true)
            ->with('user:id,name')
            ->firstOrFail();

        $portfolio->increment('views_count');

        return $portfolio;
    }
}
