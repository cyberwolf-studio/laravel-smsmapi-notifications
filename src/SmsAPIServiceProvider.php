<?php

namespace CyberWolfStudio\LaravelSmsAPINotifications;

use Illuminate\Support\ServiceProvider;
use Smsapi\Client\Curl\SmsapiHttpClient;
use Smsapi\Client\Feature\Sms\SmsFeature;

class SmsAPIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->app->when(SmsAPIPlChannel::class)
            ->needs(SmsFeature::class)
            ->give(fn () => match (config('smsapi.service', 'pl')) {
                'pl' => (new SmsapiHttpClient)->smsapiPlService(config('services.smsapi.token'))->smsFeature(),
                'com' => (new SmsapiHttpClient)->smsapiComService(config('services.smsapi.token'))->smsFeature()
            });
    }
}
