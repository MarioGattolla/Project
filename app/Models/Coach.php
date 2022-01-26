<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Coach extends Model
{
    use HasFactory;
    use Notifiable;
    use HasApiTokens;

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'age',
        'birthday',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function services():BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }
}
