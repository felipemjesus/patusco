<?php

namespace App\Http\Resources\AnimalTypes;

use App\Models\AnimalType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalTypeResource extends JsonResource
{
    /** @var AnimalType */
    public $resource;

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
