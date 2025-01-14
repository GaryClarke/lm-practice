<?php

namespace App\Providers;

use App\Contracts\SubscriptionForwarder;
use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\Forwarders\Google\SubscriptionStartForwarder;
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
        $this->app->tag([
            SubscriptionStartForwarder::class
        ], SubscriptionForwarder::class);

        // Inject tagged forwarders into GoogleWebhookHandler
        $this->app->bind(GoogleWebhookHandler::class, function (Application $app) {
            return new GoogleWebhookHandler(
                $app->make(SubscriptionFactory::class),
                $app->tagged(SubscriptionForwarder::class)
            );
        });

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
