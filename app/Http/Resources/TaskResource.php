<?php

namespace App\Http\Resources;

use App\Models\Room;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\User;
use Carbon\Carbon;
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
        /**
         * @var User $author
         * @var Room $room
         * @var TaskType $type
         * @var TaskStatus $status
        */
        $author = $this->author;
        $room   = $this->room;
        $type   = $this->type;
        $status = $this->status;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'date' => Carbon::parse($this->created_at)->setTimezone('Europe/Kyiv')->format('d.m.Y H:i'),

            'author' => [
                'id'    => $author->id,
                'name'  => $author->name,
                'email' => $author->email,
            ],
            'room' => [
                'id' => $room->id,
                'name' => $room->name,
            ],
            'type' => [
                'id' => $type->id,
                'name' => $type->name,
            ],
            'status' => [
                'id' => $status->id,
                'name' => $status->name,
            ],
        ];
    }
}
