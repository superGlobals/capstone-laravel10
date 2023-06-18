<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $student = Student::where('user_id', Auth::id())->first();

        return view('student.profile.index', compact('student'));
    }

    public function uploadProfile(Request $request, Student $student)
    {
        $request->validate([
            'image' => 'required'
        ]);

        if($request->image !== null) {

  
                Student::deleteOldImage($student->image, 'students_image');
            

            $fileName = $student->id_number . '_' . time() . '.'. request()->image->getClientOriginalExtension();
            request()->image->move(public_path('students_image'), $fileName);
        }

        $student->image = $fileName;
        $student->save();

        return to_route('student.profile')->with('message', 'Profile updated successfully');

        // Student::update([
        //     'image' =
        // ]);
    }
}
