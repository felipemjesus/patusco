<?php

namespace App\Http\Resources\Animals;

use App\Http\Resources\AnimalTypes\AnimalTypeResource;
use App\Http\Resources\Tutors\TutorResource;
use App\Http\Resources\Users\UserResource;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnimalResource extends JsonResource
{
    /** @var Animal */
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
            'age' => $this->resource->age,
            'animal_type' => AnimalTypeResource::make($this->resource->animalType()->first()),
            'tutor' => TutorResource::make($this->resource->tutor()->first()),
        ];
    }
}
