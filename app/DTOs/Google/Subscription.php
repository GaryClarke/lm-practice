<?php

declare(strict_types=1);

namespace App\DTOs\Google;

use Carbon\CarbonImmutable;

readonly class Subscription
{
    public function __construct(
        public string $subscriptionId,        // data.subscription_notification.subscription_id
        public int $notificationType,         // data.subscription_notification.notification_type
        public bool $inTrial,                 // data.subscription_notification.in_trial
        public CarbonImmutable $eventTime,    // Converted: data.event_time_millis
        public string $event,                 // From subscription_events DB lookup
        public string $category,              // From subscription_events DB lookup
        public string $productId,             // data.developer_notification.product_id
        public string $orderId,               // data.developer_notification.order_id
        public string $userId,                // data.developer_notification.user_account_id
        public string $email,                 // data.developer_notification.email
        public bool $autoRenewing,            // data.developer_notification.auto_renewing
        public CarbonImmutable $purchaseDate, // Converted: data.developer_notification.purchase_time_millis
        public CarbonImmutable $expiryDate,   // Converted: data.developer_notification.expiry_time_millis
        public string $currency,              // data.developer_notification.price_currency_code
        public string $region                 // data.developer_notification.region_code
    ) {
    }
}
