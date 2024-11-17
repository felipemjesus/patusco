<?php

namespace App\Http\Resources\Tutors;

use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorResource extends JsonResource
{
    /** @var Tutor */
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
            'email' => $this->resource->email,
        ];
    }
}
