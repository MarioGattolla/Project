<?php

namespace App\Models;

use App\Models\Service;
use App\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;


/**
 * App\Models\Inscription
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
 * @method static Builder|Inscription newModelQuery()
 * @method static Builder|Inscription newQuery()
 * @method static Builder|Inscription query()
 * @method static Builder|Inscription whereCreatedAt($value)
 * @method static Builder|Inscription whereEnd($value)
 * @method static Builder|Inscription whereId($value)
 * @method static Builder|Inscription whereStart($value)
 * @method static Builder|Inscription whereTime($value)
 * @method static Builder|Inscription whereUpdatedAt($value)
 * @method static Builder|Inscription whereUserId($value)
 * @mixin Eloquent
 */
class Inscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'time',
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
