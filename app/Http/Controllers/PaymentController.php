<?php

namespace App\Http\Controllers;

use App\Contracts\PaymentClientContract;
use App\DTOs\PaymentIntentDTO;
use App\Exceptions\GenericPaymentException;
use App\Http\Requests\StartPaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct(private PaymentClientContract $paymentClient) {}

    public function start(StartPaymentRequest $request)
    {
        $payment = Payment::create([
            'amount' => $request->validated('amount'),
            'crypto_currency' => $request->validated('crypto_currency'),
        ]);

        try {
            $response = $this->paymentClient->create($payment);
            $response_data = json_decode($response->getBody()->getContents());
            $paymentIntent = PaymentIntentDTO::fromArray($response_data);
        } catch (\Exception $e) {
            throw new GenericPaymentException();
        }

        $payment->update([
            'external_id' => $paymentIntent->payment_id,
            'status' => $paymentIntent->payment_status,
            'receiver_address' => $paymentIntent->pay_address,
            'crypto_amount' => $paymentIntent->pay_amount,
        ]);

        return new PaymentResource($payment);
    }
}
