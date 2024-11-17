<?php

namespace App\Http\Resources\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /** @var User */
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
            'token' => $this->resource->getToken(),
            'user' => new UserResource($this->resource),
        ];
    }
}
