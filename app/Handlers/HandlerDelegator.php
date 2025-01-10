<?php

declare(strict_types=1);

namespace App\Handlers;

use App\DTOs\Webhook;

class HandlerDelegator
{
    /**
     * @param iterable<WebhookHandlerInterface> $handlers
     */
    public function __construct(private iterable $handlers) {}

    /**
     * Delegates the webhook to the correct handler.
     */
    public function delegate(Webhook $webhook): void
    {
        foreach ($this->handlers as $handler) {
            if ($handler->supports($webhook)) {
                $handler->handle($webhook);
                return; // Stop after the first matching handler is found.
            }
        }
    }
}
