<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
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
}