<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use App\DTOs\Google\Subscription;
use Carbon\CarbonImmutable;
use Database\Seeders\SubscriptionEventSeeder;
use Database\Seeders\SubscriptionProviderSeeder;

use function Pest\Laravel\seed;

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature')
    ->beforeEach(fn() => $this->seed());

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createSubscription(array $overrides = []): Subscription
{
    $defaults = [
        'subscription_id' => 'premium_monthly',
        'notification_type' => 4,
        'in_trial' => false,
        'event_time' => CarbonImmutable::now(),
        'event' => 'subscription_started',
        'category' => 'START',
        'product_id' => 'premium_monthly',
        'order_id' => 'GPA.1234-5678-9012-34567',
        'user_id' => 'USER-001',
        'email' => 'joe@example.com',
        'auto_renewing' => true,
        'purchase_date' => CarbonImmutable::now(),
        'expiry_date' => CarbonImmutable::now()->addMonth(),
        'currency' => 'USD',
        'region' => 'US',
    ];

    $data = array_merge($defaults, $overrides);

    return new Subscription(
        subscription_id: $data['subscription_id'],
        notification_type: $data['notification_type'],
        in_trial: $data['in_trial'],
        event_time: $data['event_time'],
        event: $data['event'],
        category: $data['category'],
        product_id: $data['product_id'],
        order_id: $data['order_id'],
        user_id: $data['user_id'],
        email: $data['email'],
        auto_renewing: $data['auto_renewing'],
        purchase_date: $data['purchase_date'],
        expiry_date: $data['expiry_date'],
        currency: $data['currency'],
        region: $data['region']
    );
}
