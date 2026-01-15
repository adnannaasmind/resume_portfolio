<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AIRequest;
use App\Models\Payment;
use App\Models\Portfolio;
use App\Models\Resume;
use App\Models\ResumeTemplate;
use App\Models\Subscription;
use App\Models\User;

/**
 * Admin Controller
 *
 * Main dashboard controller for admin panel
 */
class AdminController extends Controller
{
    /**
     * Display admin dashboard with statistics
     */
    public function dashboard()
    {
        try {
            $stats = [
                'total_users' => User::count(),
                'total_resumes' => Resume::count(),
                'total_portfolios' => Portfolio::count(),
                'active_subscriptions' => Subscription::where('status', 'active')->count(),
                'total_revenue' => Payment::where('status', 'paid')->sum('amount') ?? 0,
                'monthly_revenue' => Payment::where('status', 'paid')
                    ->whereMonth('created_at', now()->month)
                    ->sum('amount') ?? 0,
                'ai_requests' => AIRequest::count(),
                'templates' => ResumeTemplate::count(),
            ];

            $recent_users = User::latest()->take(5)->get();
            $recent_payments = Payment::with('user')->latest()->take(5)->get();
            $revenue_chart = $this->getRevenueChartData();

            return view('admin.dashboard', compact('stats', 'recent_users', 'recent_payments', 'revenue_chart'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Get revenue chart data for last 7 months
     */
    private function getRevenueChartData()
    {
        $months = [];
        $revenue = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');
            $revenue[] = Payment::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('amount');
        }

        return [
            'labels' => $months,
            'data' => $revenue,
        ];
    }
}
