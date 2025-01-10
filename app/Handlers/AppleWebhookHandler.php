<?php

declare(strict_types=1);

namespace App\Handlers;

use app\Contracts\WebhookHandler;
use App\DTOs\Webhook;

class AppleWebhookHandler implements WebhookHandler
{
    public function supports(Webhook $webhook): bool
    {
        // TODO: Implement supports() method.
    }

    public function handle(Webhook $webhook): void
    {
        // TODO: Implement handle() method.
    }
}
