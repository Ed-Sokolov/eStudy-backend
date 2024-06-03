<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Content\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class EditController extends Controller
{
    public function __invoke(Task $task): JsonResource
    {
        return new TaskResource($task);
    }
}
