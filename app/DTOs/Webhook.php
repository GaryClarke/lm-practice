<?php

declare(strict_types=1);

namespace App\DTOs;

readonly class Webhook
{
    public function __construct(
        public string $platform,
        public array $payload
    ) {}

    public function getPlatform(): string
    {
        return $this->platform;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }
}
