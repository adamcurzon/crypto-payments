<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'crypto_currency' => $this->crypto_currency,
            'crypto_amount' => $this->crypto_amount,
            'receiver_address' => $this->receiver_address,
            'status' => $this->status,
        ];
    }
}
