<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(private User $user)
    {
    }

    public function findAll(array $params)
    {
        if ($role = $params['role'] ?? null) {
            return $this->user->where('role', $role)->get();
        }

        return $this->user->get();
    }

    public function findById(int $id): User
    {
        return $this->user->findOrFail($id);
    }
}
