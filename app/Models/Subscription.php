<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


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
class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'end',
        'start',
        'user_id',
    ];

    protected $casts = [
        'start' => 'date',
        'end' => 'date',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }


    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
