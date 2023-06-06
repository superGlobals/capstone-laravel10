<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassValidationRequest;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        $class = StudentClass::orderBy('created_at')->get();
        return view('admin.class.index', compact('class'));
    }

    public function create()
    {
        return view('admin.class.create');
    }

    public function store(ClassValidationRequest $request)
    {
        $class = new StudentClass();

        $class->course = $request->course;
        $class->year = $request->year;
        $class->section = $request->section;
        $class->save();

        return redirect()->route('class.create')->with('message', 'Class added succesfully');
    }

    public function edit($id)
    {
        $class = StudentClass::findOrFail($id);

        return view('admin.class.edit', compact('class'));
    }

    public function update(ClassValidationRequest $request, $id)
    {
        $class = StudentClass::findOrFail($id);

        $class->course = $request->course;
        $class->year = $request->year;
        $class->section = $request->section;
        $class->save();

        return redirect()->route('class.index')->with('message', 'Class updated succesfully');
    }

    public function destroy($id)
    {
        StudentClass::findOrFail($id)->delete();

        return redirect()->route('class.index')->with('message', 'Class deleted succesfully');
    }
}
