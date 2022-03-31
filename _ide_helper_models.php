<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property float $quote
 * @property Carbon|null $date
 * @property int $user_id
 * @property int $subscription_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereName($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Subscription|null $subscription
 * @property-read User|null $user
 * @method static Builder|Payment whereDate($value)
 * @method static Builder|Payment whereSubscriptionId($value)
 * @method static Builder|Payment whereQuote($value)
 * @method static Builder|Payment whereUserId($value)
 * @method static \Database\Factories\PaymentFactory factory(...$parameters)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Service newModelQuery()
 * @method static Builder|Service newQuery()
 * @method static Builder|Service query()
 * @method static Builder|Service whereCreatedAt($value)
 * @method static Builder|Service whereId($value)
 * @method static Builder|Service whereName($value)
 * @method static Builder|Service whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static Builder|Service whereDescription($value)
 * @method static Builder|Service wherePrice($value)
 * @property-read Collection|Subscription[] $subscription
 * @property-read int|null $subscription_count
 * @property-read int|null $coaches_count
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @property-read Collection|\App\Models\User[] $skill
 * @property-read int|null $skill_count
 * @method static \Database\Factories\ServiceFactory factory(...$parameters)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property int $time
 * @property Carbon|null $start
 * @property int|null $user_id
 * @property Carbon|null $end
 * @property-read Collection|Payment[] $payment
 * @property-read int|null $payment_count
 * @property-read Collection|Service[] $service
 * @property-read int|null $service_count
 * @property-read User|null $user
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereEnd($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereStart($value)
 * @method static Builder|Subscription whereTime($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @method static Builder|Subscription whereUserId($value)
 * @mixin Eloquent
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Collection|Service[] $services
 * @property-read int|null $services_count
 * @method static \Database\Factories\SubscriptionFactory factory(...$parameters)
 */
	class Subscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRole($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Subscription[] $subscription
 * @property-read int|null $subscription_count
 * @property-read Collection|Payment[] $payment
 * @property-read int|null $payment_count
 * @property-read Collection|Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read Collection|Service[] $services
 * @property-read int|null $services_count
 * @property-read Collection|Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
 * @method static Builder|User whereSurname($value)
 * @property Role $role
 * @property-read Collection|Service[] $skill
 * @property-read int|null $skill_count
 * @method static Builder|User subscribedTo(string $skill)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

