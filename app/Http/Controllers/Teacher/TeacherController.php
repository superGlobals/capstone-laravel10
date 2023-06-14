<?php

namespace App\Http\Controllers\Teacher;

use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\TeacherOwnClass;
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
        $ownClasses = TeacherOwnClass::where('teacher_id', Auth::id())->orderBy('created_at')->get();
        
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
        TeacherOwnClass::create([
            'teacher_id' => Auth::id(),
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'unique_id' => Str::random(32)
        ]);

        return redirect()->route('teacher.dashboard')->with('message', 'Class created successfully');
    }

    public function showMyStudents($unique_id)
    {
        $teacherClass = TeacherOwnClass::where('unique_id', $unique_id)->firstOrFail();

        return view('teacher.my-students.index', compact('teacherClass'));
    }
}
