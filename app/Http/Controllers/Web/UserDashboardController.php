<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(): View
    {
        /** @var User $user */
        $user = Auth::user();

        // Get user statistics
        $stats = [
            'resumes' => $user->resumes()->count(),
            'portfolios' => $user->portfolios()->count(),
            'ai_requests' => $user->aiRequests()->count(),
            'active_subscription' => $user->activeSubscription(),
        ];

        return view('frontend.dashboard.dashboard', compact('stats'));
    }
}
