<?php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Contracts\SubscriptionForwarder;
use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\Google\SubscriptionEventCategory;
use App\Mappers\SubscriptionMapper;
use App\Validators\SubscriptionValidator;

class SubscriptionStartForwarder implements SubscriptionForwarder
{
    public function __construct(
        private SubscriptionMapper $mapper,
        private SubscriptionValidator $validator
    ) {
    }

    public function supports(GoogleSubscription $googleSubscription): bool
    {
        return $googleSubscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(GoogleSubscription $googleSubscription): void
    {
        // Map to AudienceGrid
        $audienceGridSubscription = $this->mapper->mapToAudienceGrid($googleSubscription);

        // Validate the $audienceGridSubscription
        $this->validator->validate($audienceGridSubscription, $audienceGridSubscription::rules());

        dd($audienceGridSubscription);
    }
}
