# crypto-payments

An API to take crpyto payments

## Setup

1. Register for payment gateway account
2. Set enviroment variables in `.env`

    ```js
    PAYMENT_API_KEY =
    PAYMENT_FIAT_CURRENCY =
    PAYMENT_IPN_KEY =
    ```

3. Migrate the database

    ```bash
    php artisan:migrate
    ```

## Routes

### `POST` - /api/payment/start

**Body:**

```json
{
    "amount": 49.99,
    "crypto_currency": "btc"
}
```

**Response:**

```json
{
    "data": {
        "id": "01966a92-4637-709c-be4e-00dde60bd609",
        "amount": 34.56,
        "crypto_currency": "btc",
        "crypto_amount": "0.00036886",
        "receiver_address": "3FyrpKpfdQv5UzstuBFCopPcemvhwFLaoc",
        "status": "waiting"
    }
}
```

### `POST` - /api/payment/webhook

**Body:**

```json
{
    "payment_id": 5759122286,
    "payment_status": "finished"
}
```

**Response:** `200` / `400`
