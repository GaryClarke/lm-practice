<?php

declare(strict_types=1);

namespace App\Forwarders\Google;

use App\Clients\AudienceGridClient;
use App\Contracts\SubscriptionForwarder;
use App\DTOs\Google\Subscription as GoogleSubscription;
use App\DTOs\Google\SubscriptionEventCategory;
use App\Mappers\Google\SubscriptionMapper;
use App\Validators\SubscriptionValidator;

class SubscriptionStartForwarder implements SubscriptionForwarder
{
    public function __construct(
        private SubscriptionValidator $validator,
        private AudienceGridClient $audienceGridClient
    ) {
    }

    public function supports(GoogleSubscription $googleSubscription): bool
    {
        return $googleSubscription->category === SubscriptionEventCategory::START->value;
    }

    public function forward(GoogleSubscription $googleSubscription): void
    {
        // Map to AudienceGrid
        $audienceGridSubscription = (new SubscriptionMapper())->mapToAudienceGrid($googleSubscription);

        // Validate the $audienceGridSubscription
        $this->validator->validate($audienceGridSubscription, $audienceGridSubscription::rules());

        // Forward the $audienceGridSubscription data
        $this->audienceGridClient->post($audienceGridSubscription->toArray());
    }
}
