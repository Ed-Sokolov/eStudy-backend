<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\PostRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class UpdateController extends Controller
{
    public function __invoke(Room $room, PostRequest $request): JsonResource
    {
        $data = $request->validated();

        $students = $data['students'];

        unset($data['students']);

        $room->update($data);

        $room->students()->sync($students);

        return new RoomResource($room);
    }
}
