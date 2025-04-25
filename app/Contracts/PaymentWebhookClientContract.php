<?php

namespace App\Contracts;

interface PaymentWebhookClientContract
{
    public function validate_webhook(): bool;
}
