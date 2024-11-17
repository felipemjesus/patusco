<?php

namespace App\Actions\Markings;

use App\Models\Marking;
use App\Repositories\MarkingRepository;

class Create
{
    public function __construct(private MarkingRepository $markingRepository)
    {
    }

    public function __invoke(array $data): Marking
    {
        return $this->markingRepository->create($data);
    }
}
