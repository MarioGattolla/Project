<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePrice($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscription
 * @property-read int|null $subscription_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Coach[] $coaches
 * @property-read int|null $coaches_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscriptions
 * @property-read int|null $subscriptions_count
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
