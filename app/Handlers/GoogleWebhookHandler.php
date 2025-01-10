<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\WebhookHandler;
use App\DTOs\Webhook;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    /**
     * Determines if this handler supports the given webhook.
     */
    public function supports(Webhook $webhook): bool
    {
        return strtolower($webhook->getPlatform()) === self::SUPPORTED_PLATFORM;
    }

    /**
     * Processes the webhook.
     */
    public function handle(Webhook $webhook): void
    {
        dd($webhook);
        // STEP 1: Use a factory class to extract relevant data into Google\SubscriptionNotification

        // STEP 2: Loop over forwarders
            // Check if forwarder supports the notification
                // Call forward if so, passing in the notification
    }
}
