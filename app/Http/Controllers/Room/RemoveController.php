<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RemoveController extends Controller
{
    public function __invoke(Room $room): Response
    {
        $room->forceDelete();

        return response(null, 204);
    }
}
