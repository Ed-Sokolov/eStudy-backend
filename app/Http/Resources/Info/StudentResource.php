<?php

namespace App\Http\Resources\Info;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $group = $this->group;
        $user = $this->user;

        return [
            'value' => $user->id,
            'label' => $group->name . ', ' . $user->name,
        ];
    }
}
