<?php

declare(strict_types=1);

namespace App\DTOs\Google;

use App\DTOs\Webhook;
use App\Exceptions\WebhookException;
use App\Repositories\SubscriptionEventRepository;
use Carbon\CarbonImmutable;
use Throwable;

class SubscriptionFactory
{
    public function __construct(private SubscriptionEventRepository $eventRepository) {}

    /**
     * @throws WebhookException
     */
    public function create(Webhook $webhook): Subscription
    {
        try {
            $data = $webhook->getPayload();

            // Extract necessary fields from the webhook
            $subscriptionNotification = $data['data']['subscription_notification'];
            $developerNotification = $data['data']['developer_notification'];

            // Use repository to find event
            $event = $this->eventRepository->findByNotificationType(
                $subscriptionNotification['notification_type'],
                $subscriptionNotification['in_trial']
            );

            // Return a populated Subscription DTO
            return new Subscription(
                subscription_id: $subscriptionNotification['subscription_id'],
                notification_type: $subscriptionNotification['notification_type'],
                in_trial: $subscriptionNotification['in_trial'],
                event_time: CarbonImmutable::createFromTimestampMs($data['data']['event_time_millis']),
                event: $event->name,
                category: $event->category->value,
                product_id: $developerNotification['product_id'],
                order_id: $developerNotification['order_id'],
                user_id: $developerNotification['user_account_id'],
                email: $developerNotification['email'],
                auto_renewing: $developerNotification['auto_renewing'],
                purchase_date: CarbonImmutable::createFromTimestampMs($developerNotification['purchase_time_millis']),
                expiry_date: CarbonImmutable::createFromTimestampMs($developerNotification['expiry_time_millis']),
                currency: $developerNotification['price_currency_code'],
                region: $developerNotification['region_code']
            );
        } catch (Throwable $e) {
            throw new WebhookException('Unable to create Google Subscription. Reason: ' . $e->getMessage());
        }
    }
}
