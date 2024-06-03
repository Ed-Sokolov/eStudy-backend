<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Http\Resources\TaskResource;
use App\Models\Room;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Ramsey\Collection\Collection;

class ShowController extends Controller
{
    public function __invoke(Room $room): JsonResponse
    {
        /**
         * @var Collection<Task> $tasks
        */
        $tasks = $room->tasks;

        return response()->json([
            'tasks' => TaskResource::collection($tasks),
            'room' => new RoomResource($room),
        ]);
    }
}
