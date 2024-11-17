<?php

namespace App\Http\Controllers\Markings;

use App\Actions\Markings\Create;
use App\Http\Controllers\Controller;
use App\Http\Requests\Markings\CreateRequest;

class CreateController extends Controller
{
    public function __construct(private Create $create)
    {
    }

    public function __invoke(CreateRequest $request)
    {
        ($this->create)($request->validated());

        return response()->json([], '204');
    }
}
