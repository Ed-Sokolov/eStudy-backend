<?php

namespace App\Http\Controllers\Room;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\PostRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __invoke(PostRequest $request)
    {
        $data = $request->validated();

        $user = Auth::user();

        $students = $data['students'];

        unset($data['students']);

        $room = Room::query()->create([
            'name' => $data['name'],
            'user_id' => $user->id
        ]);

        $room->students()->attach($students);

        return new RoomResource($room);
    }
}
