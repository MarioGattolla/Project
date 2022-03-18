<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

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

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
       'name',
       'price',
    ];

    public function subscriptions(): BelongsToMany
    {
        return $this->belongsToMany(Subscription::class);
    }


    public function skill():BelongsToMany
    {
        return $this->belongsToMany(User::class, 'skill', 'user_id','service_id');
    }
}
