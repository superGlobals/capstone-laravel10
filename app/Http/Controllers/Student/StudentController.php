<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\TeacherOwnClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentValidationRequest;

class StudentController extends Controller
{
    /**
     * Display all students class
     */
    public function index()
    {
        // $studentClasses = DB::table('teacher_class_students')
        //                     ->join('teacher_own_classes', 'teacher_class_students.teacher_own_class_id', '=', 'teacher_own_classes.id')
        //                     ->join('teachers', 'teacher_class_students.teacher_id', '=', 'teachers.id')
        //                     ->join('students', 'teacher_class_students.student_id', '=', 'students.id')
        //                     ->join('users AS user_teacher', 'teachers.user_id', '=', 'user_teacher.id')
        //                     ->join('users AS user_student', 'students.user_id', '=', 'user_student.id')
        //                     ->select('students.id AS student_id', 'teachers.id AS teacher_id', 'user_teacher.name AS teacher_name', 'user_student.name AS student_name')
        //                     ->get();

        $student = Student::where('user_id', Auth::id())->first();

        $myClasses = DB::table('teacher_class_students')
            ->join('teacher_own_classes', 'teacher_class_students.teacher_own_class_id', '=', 'teacher_own_classes.id')
            ->join('teachers', 'teacher_class_students.teacher_id', '=', 'teachers.id')
            ->join('users AS user_teacher', 'teachers.user_id', '=', 'user_teacher.id')
            ->join('student_classes AS student_class', 'teacher_own_classes.class_id', '=', 'student_class.id')
            ->join('subjects', 'teacher_own_classes.subject_id', '=', 'subjects.id')
            ->where('teacher_class_students.student_id', $student->id)
            ->select('student_class.course AS course', 'student_class.year AS year', 'student_class.section AS section', 'subjects.subject_code AS subject_code', 'subjects.subject_title AS subject_title', 'user_teacher.name AS teacher_name')
            ->get();


        return view('student.index', compact('myClasses', 'student'));
    }

    public function showRegForm()
    {
        $classes = StudentClass::orderBy('year')->get();
        return view('student.register', compact('classes'));
    }

    public function storeStudent(StudentValidationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'student'
        ]);

        $student = new Student();

        $student->id_number = $request->id_number;
        $student->class_id = $request->class_id;
        $student->user_id = $user->id;
        $student->save();

        return redirect()->route('login')->with('message', 'Account created successfully');
    }

    public function showMyClassmate($id)
    {
        $class = TeacherOwnClass::findOrFail($id);

        $classmates = DB::table('teacher_class_students')
            ->join('teachers', 'teacher_class_students.teacher_id', '=', 'teachers.id')
            ->join('students', 'teacher_class_students.student_id', '=', 'students.id')
            ->join('users AS user_teacher', 'teachers.user_id', '=', 'user_teacher.id')
            ->join('users AS user_student', 'students.user_id', '=', 'user_student.id')
            ->where('teacher_own_class_id', $id)
            ->select('user_teacher.name AS teacher_name', 'user_student.name AS student_name')
            ->get();

        return view('student.enroll.my-classmate', compact('class', 'classmates'));
    }

    
}
