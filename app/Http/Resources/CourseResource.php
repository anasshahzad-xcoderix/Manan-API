<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'department_id' => $this->department_id,
            'name' => $this->name,
            'description' => $this->description,
            'duration' => $this->duration,
            'credit_hours' => $this->credit_hours,
            'fee' => $this->fee,
            'department' => new DepartmentResource($this->whenLoaded('department')),
        ];
    }
}
