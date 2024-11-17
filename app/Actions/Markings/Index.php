<?php

namespace App\Actions\Markings;

use App\Repositories\MarkingRepository;

class Index
{
    public function __construct(private MarkingRepository $markingRepository)
    {
    }

    public function __invoke(array $params)
    {
        return $this->markingRepository->findAll($params);
    }
}
