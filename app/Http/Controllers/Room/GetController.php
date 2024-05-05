<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function __invoke()
    {
        $allRooms = Room::all();

        return RoomResource::collection($allRooms);
    }
}
