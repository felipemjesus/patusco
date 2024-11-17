<?php

namespace App\Actions\Markings;

use App\Models\Marking;
use App\Repositories\MarkingRepository;

class Destroy
{
    public function __construct(private MarkingRepository $markingRepository)
    {
    }

    public function __invoke(Marking $marking)
    {
        return $this->markingRepository->delete($marking);
    }
}
