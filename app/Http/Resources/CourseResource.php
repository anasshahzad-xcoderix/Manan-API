<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'duration' => $this->duration,
            'credit_hours' => $this->credit_hours,
            'fee' => $this->fee,
            'students' => StudentResource::collection($this->whenLoaded('students')),
        ];
    }
}
