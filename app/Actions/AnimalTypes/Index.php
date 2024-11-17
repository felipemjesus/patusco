<?php

namespace App\Actions\AnimalTypes;

use App\Repositories\AnimalTypeRepository;

class Index
{
    public function __construct(private AnimalTypeRepository $animalTypeRepository)
    {
    }

    public function __invoke()
    {
        return $this->animalTypeRepository->findAll();
    }
}
