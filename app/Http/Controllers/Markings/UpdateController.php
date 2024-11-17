<?php

namespace App\Http\Controllers\Markings;

use App\Actions\Markings\Update;
use App\Http\Controllers\Controller;
use App\Http\Requests\Markings\UpdateRequest;
use App\Models\Marking;

class UpdateController extends Controller
{
    public function __construct(private Update $update)
    {
    }

    public function __invoke(UpdateRequest $request, Marking $marking)
    {
        ($this->update)($request->validated(), $marking);

        return response()->json([], '200');
    }
}
