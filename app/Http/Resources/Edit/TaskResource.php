<?php

namespace App\Http\Resources\Edit;

use App\Http\Resources\Info\Edit\StudentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'author' => [
                'id'    => $author->id,
                'name'  => $author->name,
                'email' => $author->email,
            ],
            'students' => StudentResource::collection($this->students),
        ];
    }
}
