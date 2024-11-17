<?php

namespace App\Http\Controllers\Markings;

use App\Actions\Markings\Destroy;
use App\Http\Controllers\Controller;
use App\Http\Requests\Markings\DestroyRequest;
use App\Models\Marking;

class DestroyController extends Controller
{
    public function __construct(private Destroy $destroy)
    {
    }

    public function __invoke(DestroyRequest $request, Marking $marking)
    {
        ($this->destroy)($marking);

        return response()->json([], '200');
    }
}
