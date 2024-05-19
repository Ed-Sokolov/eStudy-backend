<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Info\Task\RoomResource;
use App\Http\Resources\Info\Task\StatusResource;
use App\Http\Resources\Info\Task\TypeResource;
use App\Models\Room;
use App\Models\TaskStatus;
use App\Models\TaskType;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __invoke()
    {
        $statuses   = TaskStatus::all();
        $types      = TaskType::all();
        $rooms      = Room::all();

        return [
            'statuses'  => StatusResource::collection($statuses),
            'types'     => TypeResource::collection($types),
            'rooms'     => RoomResource::collection($rooms)
        ];
    }
}
