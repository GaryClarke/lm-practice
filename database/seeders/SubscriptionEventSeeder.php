<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubscriptionEvent;
use App\Models\SubscriptionProvider;
use App\DTOs\Google\SubscriptionEventCategory;

class SubscriptionEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Find the Google provider (ensure this is already seeded)
        $googleProvider = SubscriptionProvider::firstOrCreate(['name' => 'Google']);

        // Seed Google Subscription Events
        SubscriptionEvent::insert([
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_started',
                'category' => SubscriptionEventCategory::START->value,
                'notification_type' => 4,
                'in_trial' => false,
            ],
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_trial_started',
                'category' => SubscriptionEventCategory::START->value,
                'notification_type' => 4,
                'in_trial' => true,
            ],
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_renewed',
                'category' => SubscriptionEventCategory::RENEW->value,
                'notification_type' => 2,
                'in_trial' => false,
            ],
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_cancelled',
                'category' => SubscriptionEventCategory::STOP->value,
                'notification_type' => 3,
                'in_trial' => false,
            ],
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_trial_cancelled',
                'category' => SubscriptionEventCategory::STOP->value,
                'notification_type' => 3,
                'in_trial' => true,
            ],
            [
                'subscription_provider_id' => $googleProvider->id,
                'name' => 'subscription_on_hold',
                'category' => SubscriptionEventCategory::RENEW->value,
                'notification_type' => 5,
                'in_trial' => false,
            ]
        ]);
    }
}
