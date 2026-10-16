<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Models\Department;
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
}