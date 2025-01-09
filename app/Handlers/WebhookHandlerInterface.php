<?php

declare(strict_types=1);

namespace App\Handlers;

use App\DTOs\Webhook;

interface WebhookHandlerInterface
{
    /**
     * Determines if this handler supports the given webhook.
     */
    public function supports(Webhook $webhook): bool;

    /**
     * Processes the webhook.
     */
    public function handle(Webhook $webhook): void;
}
