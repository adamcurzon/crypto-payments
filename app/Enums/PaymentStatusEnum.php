<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    case CREATED = 'created';
    case WAITING = 'waiting';
    case CONFIRMING = 'confirming';
    case CONFIRMED = 'confirmed';
    case PENDING = 'pending';
    case FINISHED = 'finished';
    case FAILED = 'failed';
    case EXPIRED = 'expired';
    case REFUNDED = 'refunded';
}
