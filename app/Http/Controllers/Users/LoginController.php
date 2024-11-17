<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\Login;
use App\Http\Controllers\Controller;
use App\Http\Requests\Users\LoginRequest;
use App\Http\Resources\Users\LoginResource;

class LoginController extends Controller
{
    public function __construct(private Login $login)
    {
    }

    public function __invoke(LoginRequest $request)
    {
        return LoginResource::make(
            ($this->login)($request->validated())
        );
    }
}
