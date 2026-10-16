<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Http\Resources\CourseResource;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('students')->get();
        return CourseResource::collection($courses);
    }

    public function show($id)
    {
        $course = Course::with('students')->findOrFail($id);
        
        return new CourseResource($course);
    }
}