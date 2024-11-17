<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Marking extends Model
{
    protected $fillable = [
        'date',
        'symptoms',
        'animal_id',
        'user_id',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
