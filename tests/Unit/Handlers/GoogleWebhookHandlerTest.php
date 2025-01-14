<?php

declare(strict_types=1);

namespace Tests\Unit\Handlers;

use App\DTOs\Google\SubscriptionFactory;
use App\DTOs\Webhook;
use App\Handlers\GoogleWebhookHandler;
use App\Contracts\SubscriptionForwarder;
use Mockery;

it('returns true for supported webhooks', function () {
    $factory = Mockery::mock(SubscriptionFactory::class);
    $forwarder = Mockery::mock(SubscriptionForwarder::class);
    $handler = new GoogleWebhookHandler($factory, [$forwarder]);

    $webhook = new Webhook('google', ['data' => []]);

    expect($handler->supports($webhook))->toBeTrue();
});

it('returns false for unsupported webhooks', function () {
    $factory = Mockery::mock(SubscriptionFactory::class);
    $forwarder = Mockery::mock(SubscriptionForwarder::class);
    $handler = new GoogleWebhookHandler($factory, [$forwarder]);

    $webhook = new Webhook('apple', ['data' => []]); // Different platform

    expect($handler->supports($webhook))->toBeFalse();
});

it('processes webhook and forwards subscription to matching forwarders', function () {
    $mockFactory = Mockery::mock(SubscriptionFactory::class);
    $subscription = createSubscription(['category' => 'START']);

    $mockForwarder1 = Mockery::mock(SubscriptionForwarder::class);
    $mockForwarder2 = Mockery::mock(SubscriptionForwarder::class);

    $mockFactory->shouldReceive('create')
        ->once()
        ->andReturn($subscription);

    $mockForwarder1->shouldReceive('supports')
        ->once()
        ->with($subscription)
        ->andReturn(true);

    $mockForwarder1->shouldReceive('forward')
        ->once()
        ->with($subscription);

    $mockForwarder2->shouldReceive('supports')
        ->once()
        ->with($subscription)
        ->andReturn(false); // This forwarder does not support the subscription

    $mockForwarder2->shouldNotReceive('forward');

    $handler = new GoogleWebhookHandler($mockFactory, [$mockForwarder1, $mockForwarder2]);

    $webhook = new Webhook('google', ['data' => []]);

    $handler->handle($webhook);
});


