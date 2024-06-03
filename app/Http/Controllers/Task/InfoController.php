<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Info\Task\RoomResource;
use App\Http\Resources\Info\Task\StatusResource;
use App\Http\Resources\Info\Task\TypeResource;
use App\Models\Room;
use App\Models\TaskStatus;
use App\Models\TaskType;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $statuses   = TaskStatus::all();
        $types      = TaskType::all();

        /**
         * @var User $user
         */
        $user = Auth::user();

        $rooms = match ($user->getRoleNames()[0] ?? '') {
            'administrator' => Room::all(),
            'teacher' => Room::query()
                ->where('user_id', $user->id)
                ->get(),
            default => $user->rooms,
        };

        return response()->json([
            'statuses'  => StatusResource::collection($statuses),
            'types'     => TypeResource::collection($types),
            'rooms'     => RoomResource::collection($rooms)
        ]);
    }
}
