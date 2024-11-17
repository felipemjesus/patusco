<?php

namespace App\Http\Resources\Markings;

use App\Http\Resources\Animals\AnimalResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Marking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkingResource extends JsonResource
{
    /** @var Marking */
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
            'date' => $this->resource->date,
            'symptoms' => $this->resource->symptoms,
            'animal' => AnimalResource::make($this->resource->animal()->first()),
            'user' => UserResource::make($this->resource->user()->first()),
        ];
    }
}
