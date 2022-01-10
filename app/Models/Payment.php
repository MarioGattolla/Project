<?php

namespace App\Models;

use App\Models\User;
use App\Models\Inscription;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use phpDocumentor\Reflection\Types\Float_;

/**
 * App\Models\Payment
 *
 * @property int $id
 * @property float $quote
 * @property date $date
 * @property int $user_id
 * @property int $inscription_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Inscription|null $inscription
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUserId($value)
 */

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'quote',
        'date',
        'user_id',
        'inscription_id',
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function inscription(): BelongsTo
    {
        return $this->belongsTo(Inscription::class);
    }

}
