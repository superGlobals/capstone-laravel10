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


        return view('student.index', compact('myClasses'));
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
        })->get();

        return view('student.enroll.index', compact('classes'));
    }

    public function showMyClassmate($id)
    {
        $class = TeacherOwnClass::findOrFail($id);

        $classmates = DB::table('teacher_class_students')
                        ->join('teachers', 'teacher_class_students.teacher_id', '=', 'teachers.id')
                        ->join('students', 'teacher_class_students.student_id', '=', 'students.id')
                        ->join('users AS user_teacher', 'teachers.user_id', '=', 'user_teacher.id')
                        ->join('users AS user_student', 'students.user_id', '=', 'user_student.id')
                        ->select('user_teacher.name AS teacher_name', 'user_student.name AS student_name')
                        ->get();

        return view('student.enroll.my-classmate', compact('class', 'classmates'));
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
