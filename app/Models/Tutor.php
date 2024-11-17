<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tutor extends Model
{
    protected $fillable = [
        'name',
        'email',
    ];

    public function animals(): HasMany
    {
        return $this->hasMany(Animal::class);
    }
}
