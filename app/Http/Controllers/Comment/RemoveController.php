<?php

namespace App\Http\Controllers\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Response;

class RemoveController extends Controller
{
    public function __invoke(Comment $comment): Response
    {
        $comment->delete();

        return response(null, 204);
    }
}
