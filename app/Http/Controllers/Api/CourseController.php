<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Models\Course;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;

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

    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return (new CourseResource($course))
            ->additional(['message' => 'Course created successfully!']);
    }

    public function enrollStudent(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id'
        ]);

        $course = Course::findOrFail($id);
        
        $course->students()->syncWithoutDetaching($request->student_id);

        return response()->json([
            'message' => 'Student enrolled in course successfully!',
        ]);
    }
}