<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'course',
        'year',
        'section'
    ];

    public function teacherOwnClass()
    {
        return $this->hasMany(TeacherOwnClass::class);
    }
}
