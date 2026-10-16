<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['department', 'students'])->get();
        return CourseResource::collection($courses);
    }

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return (new CourseResource($course))
            ->additional(['message' => 'Course created successfully!']);
    }
}