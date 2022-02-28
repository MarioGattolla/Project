<?php

namespace App\Models;

use App\Enums\Role;
use Database\Factories\UserFactory;
use Eloquent;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;


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
 * @property int|null $role_id
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
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => Role::class
    ];

    public function setPasswordAttribute(string|null $plaintext_password): void
    {
        if (empty($plaintext_password)) {
            return;
        }

        $this->attributes['password'] = Hash::make($plaintext_password);
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function services(): HasManyThrough
    {
        return $this->hasManyThrough(
            Service::class,
            Subscription::class
        );
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function skill(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'skill', 'user_id', 'service_id');
    }

    public function balance(User $user): float
    {

        $debit = $user
            ->subscriptions
            ->map(fn(Subscription $subscription) => $subscription->services()->sum('price'))
            ->sum();

        $credit = $user->payments()->sum('quote');

        return $credit - $debit;
    }

    public function show_user_subscribed_services() : Collection
    {
        return $this->subscriptions
            ->flatMap(fn(Subscription $subscription) => $subscription->services->pluck('name'))
            ->unique()
            ->sort();
    }

    /**
     * @return Collection<User>
     */
    public function show_users_coached_list_for_skill($skill): Collection
    {
        return Subscription::query()
            ->whereRelation('services', 'name', $skill)
            ->with('user.subscriptions.services')
            ->get()
            ->map(fn(Subscription $subscription) => $subscription->user);
    }
}
