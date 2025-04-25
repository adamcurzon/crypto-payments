<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentWebhookController;
use Illuminate\Support\Facades\Route;

Route::post('payment/start', [PaymentController::class, 'start'])->name('payment.start');
Route::post('payment/webhook', [PaymentWebhookController::class, 'handle'])->name('payment.webhook');
