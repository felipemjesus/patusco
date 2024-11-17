<?php

namespace App\Actions\Users;

use Illuminate\Support\Facades\Auth;

class Login
{
    public function __invoke(array $data)
    {
        if (!Auth::attempt($data)) {
            throw new \Exception('Invalid credentials');
        }

        return Auth::user();
    }
}
