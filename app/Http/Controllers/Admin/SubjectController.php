<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectValidationRequest;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('created_at')->get();

        return view('admin.subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(SubjectValidationRequest $request) 
    {
        $subject = new Subject();

        $subject->subject_code = $request->subject_code;
        $subject->subject_title = $request->subject_title;
        $subject->save();

        return redirect()->route('subject.create')->with('message', 'Subject added succesfully');
    }

    public function edit($id) 
    {
        $subject = Subject::findOrFail($id);

        return view('admin.subject.edit', compact('subject'));
    }

    public function update(SubjectValidationRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->subject_code = $request->subject_code;
        $subject->subject_title = $request->subject_title;
        $subject->save();

        return redirect()->route('subject.index')->with('message', 'Subject updated succesfully');
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();

        return redirect()->route('subject.index')->with('message', 'Subject deleted succesfully');
    }
}
