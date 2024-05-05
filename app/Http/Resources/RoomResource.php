<?php

namespace App\Http\Resources;

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
            'name'   => $this->id,
            'author' => [
                'id'    => $author->id,
                'name'  => $author->name,
                'email' => $author->email,
            ],
        ];
    }
}
