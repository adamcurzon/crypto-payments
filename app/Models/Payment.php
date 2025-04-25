<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasUuids;

    protected $fillable = [
        'amount',
        'crypto_currency',
        'crypto_amount',
        'status',
        'external_id',
        'receiver_address',
    ];
}
