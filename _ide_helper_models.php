<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $subscription_provider_id
 * @property string $name
 * @property \App\DTOs\Google\SubscriptionEventCategory $category
 * @property int $notification_type
 * @property bool $in_trial
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SubscriptionProvider|null $provider
 * @method static \Database\Factories\SubscriptionEventFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereInTrial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereNotificationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereSubscriptionProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionEvent whereUpdatedAt($value)
 */
	class SubscriptionEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\SubscriptionProviderFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|SubscriptionProvider whereUpdatedAt($value)
 */
	class SubscriptionProvider extends \Eloquent {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

