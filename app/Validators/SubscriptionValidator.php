<?php

declare(strict_types=1);

namespace App\Validators;

use App\DTOs\AudienceGrid\Subscription;
use App\Exceptions\WebhookException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Validation\Factory;

class SubscriptionValidator
{
    public function __construct(private Factory $validatorFactory)
    {
    }

    /**
     * Validate the AudienceGrid subscription.
     *
     * @param Arrayable<string, mixed> $subscription
     * @throws WebhookException
     */
    public function validate(Arrayable $subscription): void
    {
        $validator = $this->validatorFactory->make(
            $subscription->toArray(),
            Subscription::rules()
        );

        if ($validator->fails()) {
            throw new WebhookException('Validation failed: ' . $validator->errors()->toJson());
        }
    }
}
