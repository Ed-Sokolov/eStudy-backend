<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Info\StudentResource;
use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class GetController extends Controller
{
    public function __invoke(): JsonResource
    {
        $students = Student::all();

        return StudentResource::collection($students);
    }
}
