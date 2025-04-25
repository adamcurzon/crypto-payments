<?php

namespace App\Clients;

use App\Contracts\PaymentClientContract;
use App\Contracts\PaymentWebhookClientContract;
use App\Models\Payment;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class NowPaymentsClient implements PaymentClientContract, PaymentWebhookClientContract
{
    const API_URL = 'https://api.nowpayments.io/v1';

    private Client $client;
    private array $headers;
    private string $currency;
    private string $ipn_key;

    public function __construct()
    {
        $this->client = new Client();
        $this->headers = [
            'x-api-key' => config('payment.api_key'),
            'Content-Type' => 'application/json'
        ];
        $this->currency = config('payment.currency');
        $this->ipn_key = config('payment.ipn_key');
    }

    public function create(Payment $payment): ResponseInterface
    {
        $request = new Request(
            'POST',
            self::API_URL . '/payment',
            $this->headers,
            json_encode([
                "price_amount" => $payment->amount,
                "price_currency" => $this->currency,
                "pay_currency" => $payment->crypto_currency,
                'ipn_callback_url' => route('payment.webhook'),
            ])
        );

        return $this->client->sendAsync($request)->wait();
    }

    public function validate_webhook(): bool
    {
        if (isset($_SERVER['HTTP_X_NOWPAYMENTS_SIG']) && !empty($_SERVER['HTTP_X_NOWPAYMENTS_SIG'])) {
            $recived_hmac = $_SERVER['HTTP_X_NOWPAYMENTS_SIG'];
            $request_json = file_get_contents('php://input');
            $request_data = json_decode($request_json, true);
            $this->tksort($request_data);
            $sorted_request_json = json_encode($request_data, JSON_UNESCAPED_SLASHES);
            if ($request_json !== false && !empty($request_json)) {
                $hmac = hash_hmac("sha512", $sorted_request_json, trim($this->ipn_key));
                if ($hmac == $recived_hmac) {
                    return true;
                }
            }
        }
        return false;
    }

    function tksort(&$array)
    {
        ksort($array);
        foreach (array_keys($array) as $k) {
            if (gettype($array[$k]) == "array") {
                $this->tksort($array[$k]);
            }
        }
    }
}
