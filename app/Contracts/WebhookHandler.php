<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\Webhook;

interface WebhookHandler
{
    public const string TAG = 'webhook-handlers';

    /**
     * Determines if this handler supports the given webhook.
     */
    public function supports(Webhook $webhook): bool;

    /**
     * Processes the webhook.
     */
    public function handle(Webhook $webhook): void;
}
