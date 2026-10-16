<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function departments()
    {
        return $this->belongsToMany(Department::class, 'course_department');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'course_student');
    }
}
