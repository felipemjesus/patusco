<?php

namespace App\Actions\Users;

use App\Repositories\UserRepository;

class Index
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function __invoke(array $params)
    {
        return $this->userRepository->findAll($params);
    }
}
