<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        return PricingPlan::orderBy('price')->get();
    }

    public function store(Request $request)
    {
        $data = $this->validatePlan($request);
        $plan = PricingPlan::create($data + [
            'slug' => Str::slug($data['name'].'-'.Str::random(3)),
        ]);

        return response()->json($plan, 201);
    }

    public function show(PricingPlan $plan)
    {
        return $plan;
    }

    public function update(Request $request, PricingPlan $plan)
    {
        $data = $this->validatePlan($request, true);
        $plan->update($data);

        return $plan;
    }

    public function destroy(PricingPlan $plan)
    {
        $plan->delete();

        return response()->noContent();
    }

    protected function validatePlan(Request $request, bool $update = false): array
    {
        return $request->validate([
            'name' => [$update ? 'sometimes' : 'required', 'string', 'max:255'],
            'price' => [$update ? 'sometimes' : 'required', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'size:3'],
            'interval' => ['nullable', 'in:monthly,yearly'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'resume_limit' => ['nullable', 'integer', 'min:1'],
            'portfolio_limit' => ['nullable', 'integer', 'min:1'],
            'template_limit' => ['nullable', 'integer', 'min:1'],
            'ai_credits' => ['nullable', 'integer', 'min:0'],
            'features' => ['nullable', 'array'],
            'stripe_price_id' => ['nullable', 'string', 'max:255'],
            'paypal_plan_id' => ['nullable', 'string', 'max:255'],
        ]);
    }
}
