<?php

namespace App\Contracts;

use App\Models\Payment;
use Psr\Http\Message\ResponseInterface;

interface PaymentClientContract
{
    public function create(Payment $payment): ResponseInterface;
}
