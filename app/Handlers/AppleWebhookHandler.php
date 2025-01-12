<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Contracts\WebhookHandler;
use App\DTOs\Webhook;

class AppleWebhookHandler implements WebhookHandler
{
    public function supports(Webhook $webhook): bool
    {
        return true;
    }

    public function handle(Webhook $webhook): void
    {
        // TODO: Implement handle() method.
    }
}
