<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\SubscriptionForwarder;
use App\Contracts\WebhookHandler;
use App\DTOs\Google\SubscriptionFactory;
use App\DTOs\Webhook;

class GoogleWebhookHandler implements WebhookHandler
{
    private const string SUPPORTED_PLATFORM = 'google';

    /**
     * @param iterable<SubscriptionForwarder> $forwarders
     */
    public function __construct(
        private SubscriptionFactory $subscriptionFactory,
        private iterable $forwarders // Injecting tagged forwarders
    ) {
    }

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
        // STEP 1: Use a factory class to extract relevant data into Google\SubscriptionNotification
        $subscription = $this->subscriptionFactory->create($webhook);

        // STEP 2: Loop over forwarders
        foreach ($this->forwarders as $forwarder) {
            // Check if forwarder supports the notification
            if ($forwarder->supports($subscription)) {
                // Call forward if so, passing in the notification
                $forwarder->forward($subscription);
            }
        }
    }
}
