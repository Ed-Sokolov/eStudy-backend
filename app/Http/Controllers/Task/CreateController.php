<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class CreateController extends Controller
{
    public function __invoke(CreateRequest $request): JsonResource
    {
        $data = $request->validated();

        $newTask = Task::query()->create($data);

        return new TaskResource($newTask);
    }
}
