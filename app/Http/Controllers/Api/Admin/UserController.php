<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::with('subscriptions.plan')->paginate();
    }

    public function show(User $user)
    {
        return $user->load(['profile', 'subscriptions.plan']);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => ['nullable', 'in:user,admin'],
            'preferred_locale' => ['nullable', 'in:en,es'],
            'pricing_plan_id' => ['nullable', 'exists:pricing_plans,id'],
        ]);

        $user->update(collect($data)->except('pricing_plan_id')->filter()->toArray());

        if (! empty($data['pricing_plan_id'])) {
            $plan = PricingPlan::find($data['pricing_plan_id']);

            Subscription::updateOrCreate(
                ['user_id' => $user->id, 'pricing_plan_id' => $plan->id],
                [
                    'provider' => 'admin',
                    'status' => 'active',
                    'renews_at' => now()->addMonth(),
                ]
            );
        }

        return $user->fresh()->load('subscriptions.plan');
    }
}
