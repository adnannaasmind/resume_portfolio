<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use App\Services\PaymentGatewayService;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __construct(protected PaymentGatewayService $gateway)
    {
    }

    public function index()
    {
        $plans = PricingPlan::where('is_active', true)->orderByDesc('is_featured')->orderBy('price')->get();
        return view('pricing.index', compact('plans'));
    }

    public function checkout(Request $request)
    {
        $data = $request->validate([
            'pricing_plan_id' => ['required', 'exists:pricing_plans,id'],
            'provider' => ['required', 'in:stripe,paypal'],
        ]);

        $plan = PricingPlan::findOrFail($data['pricing_plan_id']);
        $checkout = $this->gateway->createCheckout($request->user(), $plan, $data['provider']);

        return back()->with('status', 'Checkout initiated. Follow the link if provided: '.($checkout['checkout_url'] ?? 'Configure provider keys.'));
    }
}
