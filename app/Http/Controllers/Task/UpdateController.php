<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateRequest;
use App\Http\Resources\Content\TaskResource;
use App\Models\Attachment;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(CreateRequest $request, Task $task): JsonResource
    {
        $data = $request->validated();

        $attachments = $data['attachments'] ?? [];
        unset($data['attachments']);

        $task->update($data);

        $newAttachments = [];

        if (count($attachments) > 0)
        {
            foreach ($attachments as $attachment)
            {
                $orig_name      = $attachment->getClientOriginalName();
                $orig_extension = $attachment->getClientOriginalExtension();

                $name = md5(Carbon::now() . '_' . $orig_name) . '.' . $orig_extension;

                $filePath = Storage::disk('public')->putFileAs('/tasks/attachments', $attachment, $name);

                $type = 'image';

                switch ($attachment->getClientOriginalExtension())
                {
                    case 'doc':
                    case 'docx':
                        $type = 'doc';
                        break;
                    case 'pdf':
                        $type = 'pdf';
                        break;
                    case 'zip':
                    case 'rar':
                        $type = 'archive';
                        break;
                    case 'txt':
                        $type = 'txt';
                        break;
                    case 'xls':
                    case 'xlsx':
                        $type = 'excel';
                        break;
                    case 'ppt':
                    case 'pptx':
                        $type = 'point';
                        break;
                }

                $newAttachments[] = [
                    'task_id' => $task->id,
                    'original_name' => $orig_name,
                    'path' => $filePath,
                    'url' => url("/storage/$filePath"),
                    'type' => $type,
                ];
            }
        }

        if (count($newAttachments) > 0)
        {
            Attachment::query()->insert($newAttachments);
        }

        return new TaskResource($task);
    }
}
