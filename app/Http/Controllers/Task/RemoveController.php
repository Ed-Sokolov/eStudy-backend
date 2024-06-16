<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RemoveController extends Controller
{
    public function __invoke(Task $task): Response
    {
        $task->forceDelete();

        return response(null, 204);
    }
}
