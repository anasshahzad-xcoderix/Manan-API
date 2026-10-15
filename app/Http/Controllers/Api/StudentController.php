<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();

        return StudentResource::collection($students);
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'roll_no' => 'required|unique:students,roll_no',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        $student = Student::create($validated);

        return (new StudentResource($student))
        ->additional(['message'=> 'Student created successfully!'])
        ->response()
        ->setStatusCode(201);
    }


    public function show($id)
{
    $student = Student::with('courses')->findOrFail($id);

    return new StudentResource($student);
}
}