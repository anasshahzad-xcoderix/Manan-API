<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return StudentResource::collection($students);
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return (new StudentResource($student))
            ->additional(['message' => 'Student created successfully!']);
    }

    public function show($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        return new StudentResource($student);
    }

    public function enrollCourse(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id'
        ]);

        $student = Student::findOrFail($id);

        $student->courses()->syncWithoutDetaching($request->course_id);

        return response()->json([
            'message' => 'Course assigned to student successfully!',
        ]);
    }
}