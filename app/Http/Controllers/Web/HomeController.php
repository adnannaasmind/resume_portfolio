<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        // Get published portfolios for display
        $portfolios = Portfolio::with('user')
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.home.home', compact('portfolios'));
    }
}
