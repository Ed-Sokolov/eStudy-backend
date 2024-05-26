<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:300',
            'description' => 'nullable|string',
            'room_id' => 'required|integer|exists:rooms,id',
            'author_id' => 'required|integer|exists:users,id',
            'status_id' => 'required|integer|exists:task_statuses,id',
            'type_id' => 'required|integer|exists:task_types,id',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|file|mimes:jpeg,jpg,png,svg,webp,doc,docx,pdf,zip,rar,txt,xls,xlsx,ppt,pptx|max:10486',
        ];
    }
}
