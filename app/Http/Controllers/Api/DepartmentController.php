<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Resources\DepartmentResource;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::with('courses')->get();
        return DepartmentResource::collection($departments);
    }

    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());

        return (new DepartmentResource($department))
            ->additional(['message' => 'Department created successfully!']);
    }

    public function show($id)
    {
        $department = Department::with('courses')->findOrFail($id);

        return new DepartmentResource($department);
    }


    public function assignCourse(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id'
        ]);

        $department = Department::findOrFail($id);

        $department->courses()->syncWithoutDetaching($request->course_id);

        return response()->json([
            'message' => 'Course assigned to department successfully!',
        ]);
    }
}