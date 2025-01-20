<?php

namespace Tests\TestDoubles;

use App\Contracts\ErrorHandler;
use Throwable;

class FakeErrorHandler implements ErrorHandler
{
    private int $handleCallCount = 0;
    private ?Throwable $error = null;

    public function handle(Throwable $throwable): void
    {
        $this->handleCallCount++;
        $this->error = $throwable;
    }

    public function getHandleCallCount(): int
    {
        return $this->handleCallCount;
    }

    public function getError(): ?Throwable
    {
        return $this->error;
    }
}
