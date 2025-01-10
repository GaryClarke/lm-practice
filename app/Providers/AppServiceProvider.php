<?php

namespace App\Providers;

use App\Contracts\WebhookHandler;
use App\Handlers\AppleWebhookHandler;
use App\Handlers\GoogleWebhookHandler;
use App\Handlers\HandlerDelegator;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register and tag webhook handlers
        $this->app->bind(GoogleWebhookHandler::class);
        $this->app->bind(AppleWebhookHandler::class);

        $this->app->tag([
            GoogleWebhookHandler::class,
            AppleWebhookHandler::class
        ], WebhookHandler::class);

        // Register HandlerDelegator with tagged services
        $this->app->bind(HandlerDelegator::class, function (Application $app) {
            return new HandlerDelegator($app->tagged(WebhookHandler::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
