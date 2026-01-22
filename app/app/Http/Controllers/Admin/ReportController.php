<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;

class ReportController extends Controller
{
    public function payments()
    {
        $payments = Payment::with('user')
            ->latest()
            ->paginate(20);

        $stats = [
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'this_month' => Payment::where('status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->sum('amount'),
            'this_year' => Payment::where('status', 'paid')
                ->whereYear('created_at', now()->year)
                ->sum('amount'),
            'pending' => Payment::where('status', 'pending')->sum('amount'),
        ];

        return view('admin.reports.payments', compact('payments', 'stats'));
    }

    public function users()
    {
        $userStats = [
            'total_users' => User::count(),
            'new_this_month' => User::whereMonth('created_at', now()->month)->count(),
            'active_users' => User::whereHas('subscriptions', function ($q) {
                $q->where('status', 'active');
            })->count(),
            'users_by_role' => User::selectRaw('role, COUNT(*) as count')
                ->groupBy('role')
                ->get()
                ->pluck('count', 'role'),
        ];

        $recentUsers = User::withCount(['resumes', 'portfolios'])
            ->latest()
            ->paginate(20);

        $monthlyGrowth = $this->getUserGrowthData();

        return view('admin.reports.users', compact('userStats', 'recentUsers', 'monthlyGrowth'));
    }

    private function getUserGrowthData()
    {
        $months = [];
        $users = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y');
            $users[] = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        return [
            'labels' => $months,
            'data' => $users,
        ];
    }
}
