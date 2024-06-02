<?php

namespace App\Http\Resources\Info\Edit;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $student = Student::query()
            ->where('user_id', $this->id)
            ->first();

        $group = $student->group;

        return [
            'value' => $this->id,
            'label' => $group->name . ', ' . $this->name,
        ];
    }
}
