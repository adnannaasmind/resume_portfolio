<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PricingPlan;
use App\Models\Subscription;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(protected PaymentGatewayService $gatewayService)
    {
    }

    public function plans()
    {
        return PricingPlan::query()
            ->where('is_active', true)
            ->orderByDesc('is_featured')
            ->orderBy('price')
            ->get();
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'pricing_plan_id' => ['required', 'exists:pricing_plans,id'],
            'provider' => ['required', 'in:stripe,paypal'],
        ]);

        $plan = PricingPlan::findOrFail($data['pricing_plan_id']);
        $user = $request->user();

        $checkout = $this->gatewayService->createCheckout($user, $plan, $data['provider']);

        $subscription = Subscription::updateOrCreate(
            ['user_id' => $user->id, 'pricing_plan_id' => $plan->id],
            [
                'provider' => $data['provider'],
                'status' => 'pending',
                'renews_at' => now()->addMonth(),
            ]
        );

        $payment = Payment::create([
            'user_id' => $user->id,
            'pricing_plan_id' => $plan->id,
            'subscription_id' => $subscription->id,
            'provider' => $data['provider'],
            'provider_payment_id' => $checkout['reference'],
            'amount' => $plan->price,
            'currency' => $plan->currency,
            'status' => 'pending',
            'raw_response' => $checkout,
        ]);

        return response()->json([
            'checkout' => $checkout,
            'payment' => $payment,
        ]);
    }

    public function history(Request $request)
    {
        return $request->user()
            ->payments()
            ->with('plan')
            ->latest()
            ->paginate();
    }

    public function currentSubscription(Request $request)
    {
        $subscription = $request->user()
            ->subscriptions()
            ->with('plan')
            ->whereIn('status', ['active', 'pending', 'trialing'])
            ->latest()
            ->first();

        return $subscription ?? response()->json(['message' => 'No subscription'], 404);
    }
}
