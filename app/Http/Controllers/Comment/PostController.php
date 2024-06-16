<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\PostRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __invoke(PostRequest $request): JsonResource
    {
        $data = $request->validated();

        $user_id = Auth::id();

        $data['user_id'] = $user_id;

        $comment = Comment::query()
            ->create($data);

        return new CommentResource($comment);
    }
}
