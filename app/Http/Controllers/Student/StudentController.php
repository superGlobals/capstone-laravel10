<?php

namespace App\Http\Controllers\Student;

use App\Models\User;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Models\TeacherOwnClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StudentValidationRequest;

class StudentController extends Controller
{
    public function index()
    {
        return view('student.index');
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
        
        // filter the class result it will show only the available class base on the student enrolled year
        $classes = TeacherOwnClass::with('class')->whereHas('class', function($query) use ($studentCourse, $studentYear, $studentSection) {
            $query->where('course', $studentCourse)
                  ->where('year', $studentYear)
                  ->where('section', $studentSection);
        })->get();
        return view('student.enroll.index', compact('classes'));
    }

    public function showMyClassmate($id)
    {
        return view('student.enroll.my-classmate');
    }
}
