<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['department', 'students'])->get();
        return CourseResource::collection($courses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => 'required|exists:departments,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|string',
            'credit_hours' => 'required|integer',
            'fee' => 'required|numeric',
        ]);

        $course = Course::create($validated);

        return (new CourseResource($course))
            ->additional(['message' => 'Course created successfully!'])
            ->response()
            ->setStatusCode(201);
    }
}