<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\TeacherOwnClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function showEnroll()
    {
        $student = Student::where('user_id', Auth::id())->first();
        $studentCourse = $student->class->course;
        $studentYear = $student->class->year;
        $studentSection = $student->class->section;

        // $teacherClassStudent = DB::table('teacher_class_students')
        //                          ->select('teacher_own_class_id', 'student_id')
        //                          ->first();

        // $teacher_own_class_id = $teacherClassStudent->teacher_own_class_id;
        // $student_id = $teacherClassStudent->student_id;

        // filter the class result it will show only the available class base on the student enrolled year
        $classes = TeacherOwnClass::with('class')->whereHas('class', function ($query) use ($studentCourse, $studentYear, $studentSection) {
            $query->where('course', $studentCourse)
                ->where('year', $studentYear)
                ->where('section', $studentSection);
        })
            ->get();


        // $classes = TeacherOwnClass::all();

        return view('student.enroll.index', compact('classes'));
    }

    public function enrollToThisClass(TeacherOwnClass $class)
    {
        $studentId = Student::where('user_id', Auth::id())->value('id');

        // $teacherClassStudent = DB::table('teacher_class_students')
        //                          ->select('teacher_own_class_id', 'student_id')
        //                          ->first();
        // $res = $teacherClassStudent->teacher_own_class_id ?? null;
        // if($class->id === $res && $teacherClassStudent->student_id === $studentId) {
        //     return back()->with('message', 'You are already enroll in this class');

        // }

        DB::table('teacher_class_students')->insert([
            'teacher_own_class_id' => $class->id,
            'teacher_id' => $class->teacher_id,
            'student_id' => $studentId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('student.dashboard')->with('message', 'Enrolled successfully');
    }
}
