<?php

namespace App\Services;

use App\Models\PricingPlan;
use App\Models\User;
use Illuminate\Support\Str;
use Stripe\StripeClient;

class PaymentGatewayService
{
    public function createCheckout(User $user, PricingPlan $plan, string $provider): array
    {
        return match ($provider) {
            'stripe' => $this->stripeCheckout($user, $plan),
            'paypal' => $this->paypalCheckout($user, $plan),
            default => throw new \InvalidArgumentException('Unsupported payment provider'),
        };
    }

    protected function stripeCheckout(User $user, PricingPlan $plan): array
    {
        $secret = config('services.stripe.secret_key');

        if (! $secret || ! $plan->stripe_price_id) {
            return $this->placeholderCheckout('stripe', $plan);
        }

        try {
            $stripe = new StripeClient($secret);
            $session = $stripe->checkout->sessions->create([
                'mode' => 'subscription',
                'line_items' => [
                    [
                        'price' => $plan->stripe_price_id,
                        'quantity' => 1,
                    ],
                ],
                'customer_email' => $user->email,
                'success_url' => url('/payments/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => url('/payments/cancelled'),
            ]);

            return [
                'provider' => 'stripe',
                'reference' => $session->id,
                'checkout_url' => $session->url,
                'status' => 'pending',
            ];
        } catch (\Throwable $exception) {
            return $this->placeholderCheckout('stripe', $plan, $exception->getMessage());
        }
    }

    protected function paypalCheckout(User $user, PricingPlan $plan): array
    {
        $clientId = config('services.paypal.client_id');
        $planId = $plan->paypal_plan_id;

        if (! $clientId || ! $planId) {
            return $this->placeholderCheckout('paypal', $plan);
        }

        // A real PayPal call would go here. For the MVP we respond with a placeholder reference.
        return $this->placeholderCheckout('paypal', $plan);
    }

    protected function placeholderCheckout(string $provider, PricingPlan $plan, ?string $note = null): array
    {
        return [
            'provider' => $provider,
            'reference' => Str::uuid()->toString(),
            'checkout_url' => null,
            'status' => 'pending',
            'note' => $note ?? 'Configure provider credentials to enable live checkout.',
            'plan' => $plan->only(['id', 'name', 'price', 'currency']),
        ];
    }
}
