<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Models\Room;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;
use Ramsey\Collection\Collection;

class ShowController extends Controller
{
    public function __invoke(Room $room): JsonResource
    {
        /**
         * @var Collection<Task> $tasks
        */
        $tasks = $room->tasks;

        return TaskResource::collection($tasks);
    }
}
