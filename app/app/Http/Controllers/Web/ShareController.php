<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Resume;

class ShareController extends Controller
{
    public function resume(string $token)
    {
        $resume = Resume::where('share_token', $token)
            ->where('is_public', true)
            ->with(['template', 'user:id,name'])
            ->firstOrFail();

        return view('frontend.pages.share.resume', compact('resume'));
    }

    public function portfolio(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)
            ->where('is_public', true)
            ->with('user:id,name')
            ->firstOrFail();

        return view('frontend.pages.share.portfolio', compact('portfolio'));
    }
}
