<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Animal extends Model
{
    protected $fillable = [
        'name',
        'age',
        'animal_type_id',
        'tutor_id',
    ];

    public function animalType(): BelongsTo
    {
        return $this->belongsTo(AnimalType::class);
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }
}
