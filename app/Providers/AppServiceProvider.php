<?php

namespace App\Providers;

use App\Clients\NowPaymentsClient;
use App\Contracts\PaymentClientContract;
use App\Contracts\PaymentWebhookClientContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        PaymentClientContract::class => NowPaymentsClient::class,
        PaymentWebhookClientContract::class => NowPaymentsClient::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
