<?php

namespace App\Actions\Markings;

use App\Models\Marking;
use App\Repositories\MarkingRepository;

class Update
{
    public function __construct(private MarkingRepository $markingRepository)
    {
    }

    public function __invoke(array $data, Marking $marking)
    {
        return $this->markingRepository->update($data, $marking);
    }
}
