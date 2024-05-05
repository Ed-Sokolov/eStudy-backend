<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Resources\Json\JsonResource;

class GetController extends Controller
{
    public function __invoke(): JsonResource
    {
        $allRooms = Room::all();

        return RoomResource::collection($allRooms);
    }
}
