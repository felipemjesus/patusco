<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository
{
    public function __construct(
        private Animal $animal,
        private AnimalTypeRepository $animalTypeRepository,
        private TutorRepository $tutorRepository
    )
    {
    }

    public function create(array $data): Animal
    {
        $animalType = $this->animalTypeRepository->findById($data['animal_type']['id']);

        $tutor = $this->tutorRepository->create($data['tutor']);

        return $this->animal->firstOrCreate([
            'name' => $data['name'],
            'age' => $data['age'],
            'animal_type_id' => $animalType->id,
            'tutor_id' => $tutor->id,
        ]);
    }

    public function update(array $data): Animal
    {
        $animalType = $this->animalTypeRepository->findById($data['animal_type']['id']);

        $tutor = $this->tutorRepository->update($data['tutor']);

        $animal = $this->animal->findOrFail($data['id']);

        $animal->fill([
            'name' => $data['name'],
            'age' => $data['age'],
            'animal_type_id' => $animalType->id,
            'tutor_id' => $tutor->id,
        ]);

        $animal->save();

        return $animal;
    }
}
