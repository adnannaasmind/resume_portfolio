<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Resume;
use App\Models\Subscription;
use App\Models\User;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'users' => User::count(),
            'resumes' => Resume::count(),
            'subscriptions' => Subscription::where('status', 'active')->count(),
            'revenue' => Payment::where('status', 'paid')->sum('amount'),
        ]);
    }
}
