<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


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

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'user_id',
        'subscription_id',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

}
