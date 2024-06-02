<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\Edit\TaskResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class EditController extends Controller
{
    public function __invoke(Room $room): JsonResource
    {
        return new TaskResource($room);
    }
}
