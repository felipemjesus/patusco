<?php

namespace App\Repositories;

use App\Models\AnimalType;

class AnimalTypeRepository
{
    public function __construct(private AnimalType $animalType)
    {
    }

    public function findAll()
    {
        return $this->animalType->all();
    }

    public function findById(int $id): ?AnimalType
    {
        return $this->animalType->findOrFail($id);
    }
}
