<?php

namespace App\Http\Controllers\Attachment;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;

class RemoveController extends Controller
{
    public function __invoke(Attachment $attachment): JsonResponse
    {
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();

        return response()
            ->json([
                'message' => 'Successfully deleted attachment.'
            ]);
    }
}
