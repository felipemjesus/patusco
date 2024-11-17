<?php

namespace App\Repositories;

use App\Models\Marking;
use App\Models\User;

class MarkingRepository
{
    public function __construct(
        private Marking $marking,
        private AnimalRepository $animalRepository,
        private UserRepository $userRepository
    )
    {
    }

    public function findAll(array $params = [])
    {
        $markings = $this->marking->query();

        if ($date = $params['date'] ?? null) {
            $markings->whereBetween('date', ["$date 00:00:00", "$date 23:59:59"]);
        }

        if ($animal_type = $params['animal_type'] ?? null) {
            $markings->whereHas('animal', function ($query) use ($animal_type) {
                $query->where('animal_type_id', $animal_type);
            });
        }

        /** @var User $user */
        $user = auth()->user();
        if ($user->isDoctor()) {
            return $markings->where('user_id', $user->id)->paginate();
        }

        return $markings->paginate();
    }

    public function create(array $data)
    {
        $animal = $this->animalRepository->create($data['animal']);

        return $this->marking->create([
            'animal_id' => $animal->id,
            'symptoms' => $data['symptoms'],
            'date' => "{$data['date']} {$data['hour']}",
        ]);
    }

    public function update(array $data, Marking $marking)
    {
        $animal = $this->animalRepository->update($data['animal']);

        $user = $this->userRepository->findById($data['user']['id']);

        $marking->fill([
            'animal_id' => $animal->id,
            'user_id' => $user->id,
            'symptoms' => $data['symptoms'],
            'date' => "{$data['date']} {$data['hour']}",
        ]);

        $marking->save();

        return $marking;
    }

    public function delete(Marking $marking)
    {
        return $marking->delete();
    }
}
