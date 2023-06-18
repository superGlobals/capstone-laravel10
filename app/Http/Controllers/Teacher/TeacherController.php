<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\TeacherOwnClass;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TeacherValidationRequest;
use App\Http\Requests\TeacherOwnClassValidationRequest;

class TeacherController extends Controller
{
    public function index()
    {
        $classes = StudentClass::orderBy('year')->get();
        $subjects = Subject::all();
        $teacherId = Teacher::where('user_id', Auth::id())->value('id');

        $ownClasses = TeacherOwnClass::where('teacher_id', $teacherId)->orderBy('created_at')->paginate(6);
        
        return view('teacher.index', compact('classes', 'subjects', 'ownClasses'));
    }

    public function registerForm()
    {
        return view('teacher.register');
    }

    public function storeTeacher(TeacherValidationRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'teacher'
        ]);

        $teacher = new Teacher();

        $teacher->id_number = $request->id_number;
        $teacher->user_id = $user->id;
        $teacher->save();

        return redirect()->route('login')->with('message', 'Account created successfully');
    }

    public function storeClass(TeacherOwnClassValidationRequest $request)
    {
        $teacherId = Teacher::where('user_id', Auth::id())->value('id');

        TeacherOwnClass::create([
            'teacher_id' => $teacherId,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'unique_id' => Str::random(32),
            'student_limit' => $request->student_limit
        ]);

        return redirect()->route('teacher.dashboard')->with('message', 'Class created successfully');
    }

    public function showMyStudents($id)
    {
        $teacherClass = TeacherOwnClass::where('id', $id)->firstOrFail();

        $myStudents = DB::table('teacher_class_students')
                        ->join('teacher_own_classes', 'teacher_class_students.teacher_own_class_id', '=', 'teacher_own_classes.id')
                        ->join('teachers', 'teacher_class_students.teacher_id', '=', 'teachers.id')
                        ->join('students', 'teacher_class_students.student_id', '=', 'students.id')
                        ->join('users AS user_teacher', 'teachers.user_id', '=', 'user_teacher.id')
                        ->join('users AS user_student', 'students.user_id', '=', 'user_student.id')
                        ->where('teacher_own_class_id', $id)
                        ->orderBy('user_student.name', 'ASC')
                        ->select('students.id AS student_id', 'user_student.name AS student_name')
                        ->get();

        return view('teacher.my-students.index', compact('teacherClass', 'myStudents'));
    }
}
