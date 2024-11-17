<?php

namespace App\Http\Controllers\Markings;

use App\Actions\Markings\Index;
use App\Http\Controllers\Controller;
use App\Http\Requests\Markings\IndexRequest;
use App\Http\Resources\Markings\MarkingResource;

class IndexController extends Controller
{
    public function __construct(private Index $index)
    {
    }

    public function __invoke(IndexRequest $request)
    {
        return MarkingResource::collection(
            ($this->index)($request->validated())
        );
    }
}
