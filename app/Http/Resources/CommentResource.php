<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'date' => Carbon::parse($this->created_at)->setTimezone('Europe/Kyiv')->format('d.m.Y H:i'),

            'author' => [
                'id' => $author->id,
                'name' => $author->name,
                'email' => $author->email,
            ],
        ];
    }
}
