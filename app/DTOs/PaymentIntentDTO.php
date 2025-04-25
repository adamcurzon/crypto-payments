<?php

namespace App\DTOs;

class PaymentIntentDTO
{
    public function __construct(
        public readonly ?string $payment_id,
        public readonly ?string $payment_status,
        public readonly ?string $pay_address,
        public readonly ?string $price_amount,
        public readonly ?string $price_currency,
        public readonly ?string $pay_amount,
        public readonly ?string $amount_received,
        public readonly ?string $pay_currency,
        public readonly ?string $order_id,
        public readonly ?string $order_description,
    ) {}

    public static function fromArray(object $data): self
    {
        return new self(
            payment_id: $data->payment_id ?? null,
            payment_status: $data->payment_status ?? null,
            pay_address: $data->pay_address ?? null,
            price_amount: $data->price_amount ?? null,
            price_currency: $data->price_currency ?? null,
            pay_amount: $data->pay_amount ?? null,
            amount_received: $data->amount_received ?? null,
            pay_currency: $data->pay_currency ?? null,
            order_id: $data->order_id ?? null,
            order_description: $data->order_description ?? null,
        );
    }
}
