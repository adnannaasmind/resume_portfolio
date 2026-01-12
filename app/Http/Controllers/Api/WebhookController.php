<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WebhookController extends Controller
{
    public function handleStripe(Request $request)
    {
        $event = $request->all();
        $type = $event['type'] ?? '';
        $sessionId = data_get($event, 'data.object.id');

        if ($type === 'checkout.session.completed' && $sessionId) {
            $this->markPaymentAsPaid('stripe', $sessionId);
        }

        return response()->json(['received' => true]);
    }

    public function handlePayPal(Request $request)
    {
        $event = $request->all();
        $resourceId = data_get($event, 'resource.id');

        if (($event['event_type'] ?? '') === 'CHECKOUT.ORDER.APPROVED' && $resourceId) {
            $this->markPaymentAsPaid('paypal', $resourceId);
        }

        return response()->json(['received' => true]);
    }

    protected function markPaymentAsPaid(string $provider, string $reference): void
    {
        $payment = Payment::query()
            ->where('provider', $provider)
            ->where('provider_payment_id', $reference)
            ->first();

        if (!$payment) {
            return;
        }

        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        $subscription = $payment->subscription;

        if ($subscription) {
            $subscription->update([
                'status' => 'active',
                'renews_at' => now()->addMonth(),
            ]);
        }
    }
}
