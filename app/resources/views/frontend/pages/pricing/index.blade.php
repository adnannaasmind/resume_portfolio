@extends('frontend.layouts.master')
@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-semibold">Pricing</h1>
    <p class="text-sm text-gray-600">Choose a plan and proceed to checkout (Stripe/PayPal).</p>
</div>

<div class="grid md:grid-cols-3 gap-4">
    @foreach($plans as $plan)
        <div class="bg-white shadow rounded p-4 border {{ $plan->is_featured ? 'border-indigo-500' : 'border-gray-200' }}">
            <div class="flex justify-between items-center">
                <div class="text-lg font-semibold">{{ $plan->name }}</div>
                @if($plan->is_featured)
                    <span class="text-xs text-indigo-700 bg-indigo-50 px-2 py-1 rounded">Popular</span>
                @endif
            </div>
            <div class="mt-2 text-3xl font-bold">${{ rtrim(rtrim($plan->price, '0'), '.') }}<span class="text-sm text-gray-500">/{{ $plan->interval }}</span></div>
            <ul class="mt-3 text-sm text-gray-700 space-y-1">
                @foreach($plan->features ?? [] as $feature)
                    <li>• {{ $feature }}</li>
                @endforeach
            </ul>
            @auth
                <form method="POST" action="{{ route('pricing.checkout') }}" class="mt-4 space-y-2">
                    @csrf
                    <input type="hidden" name="pricing_plan_id" value="{{ $plan->id }}">
                    <select name="provider" class="w-full border rounded px-3 py-2">
                        <option value="stripe">Stripe</option>
                        <option value="paypal">PayPal</option>
                    </select>
                    <button class="w-full px-4 py-2 bg-indigo-600 text-white rounded">Checkout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mt-4 inline-block px-4 py-2 bg-indigo-600 text-white rounded">Login to purchase</a>
            @endauth
        </div>
    @endforeach
</div>
@endsection
