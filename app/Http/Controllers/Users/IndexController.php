<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\Index;
use App\Http\Requests\Users\IndexRequest;
use App\Http\Resources\Users\UserResource;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function __construct(private Index $index)
    {
    }

    public function __invoke(IndexRequest $request)
    {
        return UserResource::collection(
            ($this->index)($request->validated())
        );
    }
}
