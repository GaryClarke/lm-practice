<?php

declare(strict_types=1);

namespace App\DTOs\Google;

use Carbon\CarbonImmutable;

readonly class Subscription
{
    public function __construct(
        public string $subscription_id,        // data.subscription_notification.subscription_id
        public int $notification_type,         // data.subscription_notification.notification_type
        public bool $in_trial,                 // data.subscription_notification.in_trial
        public CarbonImmutable $event_time,    // Converted: data.event_time_millis
        public string $event,                  // From subscription_events DB lookup
        public string $category,               // From subscription_events DB lookup
        public string $product_id,             // data.developer_notification.product_id
        public string $order_id,               // data.developer_notification.order_id
        public string $user_id,                // data.developer_notification.user_account_id
        public string $email,                  // data.developer_notification.email
        public bool $auto_renewing,            // data.developer_notification.auto_renewing
        public CarbonImmutable $purchase_date, // Converted: data.developer_notification.purchase_time_millis
        public CarbonImmutable $expiry_date,   // Converted: data.developer_notification.expiry_time_millis
        public string $currency,               // data.developer_notification.price_currency_code
        public string $region                 // data.developer_notification.region_code
    ) {
    }
}
