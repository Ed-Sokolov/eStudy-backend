<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class GetController extends Controller
{
    public function __invoke(): JsonResource
    {
        /**
         * @var User $user
        */
        $user = Auth::user();

        $allRooms = match ($user->getRoleNames()[0] ?? '') {
            'administrator' => Room::all(),
            'teacher' => Room::query()
                ->where('user_id', $user->id)
                ->get(),
            default => $user->rooms,
        };

        return RoomResource::collection($allRooms);
    }
}
