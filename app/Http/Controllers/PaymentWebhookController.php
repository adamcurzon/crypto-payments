<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentWebhookClientContract;
use App\DTOs\PaymentWebhookDTO;
use App\Exceptions\GenericPaymentException;
use App\Models\Payment;
use Illuminate\Http\Request;
use JsonException;

class PaymentWebhookController extends Controller
{
    public function __construct(private PaymentWebhookClientContract $paymentWebhookClient) {}

    public function handle(Request $request)
    {
        if ($this->paymentWebhookClient->validate_webhook() === false) {
            throw new GenericPaymentException();
        }

        $paymentWebhook = PaymentWebhookDTO::fromArray(json_decode($request->getContent()));

        $payment = Payment::where('external_id', $paymentWebhook->payment_id)->first();

        if (!$payment) {
            throw new JsonException('Payment not found');
        }

        $payment->update([
            'status' => $paymentWebhook->payment_status,
        ]);
    }
}
