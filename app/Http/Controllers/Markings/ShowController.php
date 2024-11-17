<?php

namespace App\Http\Controllers\Markings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Markings\ShowRequest;
use App\Http\Resources\Markings\MarkingResource;
use App\Models\Marking;

class ShowController extends Controller
{
    public function __invoke(ShowRequest $request, Marking $marking)
    {
        return MarkingResource::make($marking);
    }
}
