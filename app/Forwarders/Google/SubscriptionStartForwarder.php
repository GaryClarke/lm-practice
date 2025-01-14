<?php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Contracts\SubscriptionForwarder;
use App\DTOs\Google\Subscription;
use App\DTOs\Google\SubscriptionEventCategory;

class SubscriptionStartForwarder implements SubscriptionForwarder
{
    public function supports(Subscription $subscription): bool
    {
        return $subscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(Subscription $subscription): void
    {
        dd($subscription);
    }
}
