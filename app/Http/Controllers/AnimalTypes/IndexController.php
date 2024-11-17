<?php

namespace App\Http\Controllers\AnimalTypes;

use App\Actions\AnimalTypes\Index;
use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalTypes\AnimalTypeResource;
use Illuminate\Support\Facades\Request;

class IndexController extends Controller
{
    public function __construct(private Index $index)
    {
    }

    public function __invoke(Request $request)
    {
        return AnimalTypeResource::collection(
            ($this->index)()
        );
    }
}
