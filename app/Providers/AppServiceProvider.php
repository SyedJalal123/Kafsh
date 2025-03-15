<?php

namespace App\Providers;
use App\Mail\BrevoTransport;
use Illuminate\Mail\MailManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->make(MailManager::class)->extend('brevo', function () {
        //     return new BrevoTransport(env('BREVO_API_KEY'));
        // });


        // // Register custom mail transport for Brevo
        // $this->app->singleton(MailManager::class, function ($app) {
        //     $mailer = new MailManager($app);

        //     // Register the 'brevo' transport
        //     $mailer->extend('brevo', function () {
        //         $apiKey = env('BREVO_API_KEY'); // API key from your .env
        //         return new BrevoTransport($apiKey);
        //     });
        //     return $mailer;
        // });
    }
}
