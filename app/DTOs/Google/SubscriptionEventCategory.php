<?php

declare(strict_types=1);

namespace App\DTOs\Google;

enum SubscriptionEventCategory: string
{
    case START = 'START';
    case RENEW = 'RENEW';
    case STOP = 'STOP';
    case CHANGE = 'CHANGE';
    case NO_CHANGE = 'NO_CHANGE';
}
