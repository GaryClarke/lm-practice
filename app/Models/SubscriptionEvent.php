<?php

declare(strict_types=1);

namespace App\Models;

use App\DTOs\Google\SubscriptionEventCategory;
use Database\Factories\SubscriptionEventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionEvent extends Model
{
    /** @use HasFactory<SubscriptionEventFactory> */
    use HasFactory;

    protected $fillable = [
        'subscription_provider_id',
        'name',
        'category',
        'notification_type',
        'in_trial',
    ];

    protected $casts = [
        'category' => SubscriptionEventCategory::class, // Cast category to Enum
        'in_trial' => 'boolean',
    ];

    /**
     * Get the subscription provider that owns the event.
     *
     * @phpstan-ignore missingType.generics
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(SubscriptionProvider::class);
    }
}
