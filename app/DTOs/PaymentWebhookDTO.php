<?php

namespace App\DTOs;

class PaymentWebhookDTO
{
    public function __construct(
        public readonly ?string $payment_id,
        public readonly ?string $payment_status,
    ) {}

    public static function fromArray(object $data): self
    {
        return new self(
            payment_id: $data->payment_id ?? null,
            payment_status: $data->payment_status ?? null,
        );
    }
}
