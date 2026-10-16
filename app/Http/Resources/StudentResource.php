<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'roll_no' => $this->roll_no,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'city' => $this->city,
            'address' => $this->address,
            'courses' => CourseResource::collection($this->whenLoaded('courses')),
        ];
    }
}