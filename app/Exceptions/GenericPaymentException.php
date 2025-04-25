<?php

namespace App\Exceptions;

use Exception;

class GenericPaymentException extends Exception
{
    public function __construct(string $message = "An error occurred with the payment process.", int $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function render($request)
    {
        return response()->json([
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ], 400);
    }
}
