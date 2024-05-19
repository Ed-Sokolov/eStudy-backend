<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request)
    {
        $data = $request->validated();

        $newTask = Task::query()->create($data);

        return new TaskResource($newTask);
    }
}
