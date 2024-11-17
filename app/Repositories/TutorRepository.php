<?php

namespace App\Repositories;

use App\Models\Tutor;

class TutorRepository
{
    public function __construct(private Tutor $tutor)
    {
    }

    public function create(array $data): Tutor
    {
        return $this->tutor->firstOrCreate($data);
    }

    public function update(array $data): Tutor
    {
        $tutor = $this->tutor->findOrFail($data['id']);

        $tutor->fill($data);

        $tutor->save();

        return $tutor;
    }
}
