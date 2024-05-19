<?php

namespace App\Http\Resources\Info\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $author = $this->author;

        return [
            'value' => $this->id,
            'label' => $this->name . ', ' . $author->name,
        ];
    }
}
