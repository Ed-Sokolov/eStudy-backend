<?php

namespace App\Http\Controllers\Room\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\TaskResource;
use App\Models\Room;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowController extends Controller
{
    public function __invoke(Room $room, Task $task): JsonResource
    {
        return new TaskResource($task);
    }
}
