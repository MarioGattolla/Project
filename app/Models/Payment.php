<?php

namespace App\Models;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Carbon;


/**
 * App\Models\Payment
 *
 * @property int $id
 * @property float $quote
 * @property Carbon|null $date
 * @property int $user_id
 * @property int $subscription_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Subscription|null $subscription
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSubscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
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
