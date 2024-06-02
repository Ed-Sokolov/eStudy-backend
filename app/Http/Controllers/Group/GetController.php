<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Resources\Info\GroupResource;
use App\Models\Group;
use Illuminate\Http\Resources\Json\JsonResource;

class GetController extends Controller
{
    public function __invoke(): JsonResource
    {
        $groups = Group::all();

        return GroupResource::collection($groups);
    }
}
