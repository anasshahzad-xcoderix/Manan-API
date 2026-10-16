<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roll_no' => 'required|unique:students,roll_no',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string',
            'gender' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
        ];
    }
}