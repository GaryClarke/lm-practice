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
                (int) $subscriptionNotification['notification_type'],
                $subscriptionNotification['in_trial']
            );

            // Return a populated Subscription DTO
            // @phpstan-ignore argument.type
            return new Subscription(
                subscriptionId: $subscriptionNotification['subscription_id'],
                notificationType: $subscriptionNotification['notification_type'],
                inTrial: $subscriptionNotification['in_trial'],
                eventTime: CarbonImmutable::createFromTimestampMs($data['data']['event_time_millis']),
                event: $event->name,
                category: $event->category->value,
                productId: $developerNotification['product_id'],
                orderId: $developerNotification['order_id'],
                userId: $developerNotification['user_account_id'],
                email: $developerNotification['email'],
                autoRenewing: $developerNotification['auto_renewing'],
                purchaseDate: CarbonImmutable::createFromTimestampMs($developerNotification['purchase_time_millis']),
                expiryDate: CarbonImmutable::createFromTimestampMs($developerNotification['expiry_time_millis']),
                currency: $developerNotification['price_currency_code'],
                region: $developerNotification['region_code']
            );
        } catch (Throwable $e) {
            throw new WebhookException('Unable to create Google Subscription. Reason: ' . $e->getMessage());
        }
    }
}
