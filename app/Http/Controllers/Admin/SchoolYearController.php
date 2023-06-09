<?php

namespace App\Http\Controllers\Admin;

use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SchoolYearController extends Controller
{
    public function index()
    {
        $sys = SchoolYear::orderBy('created_at')->get();
        


        return view('admin.sy.index', compact('sys'));
    }

    public function create()
    {
        return view('admin.sy.create');
    }

    public function store(Request $request)
    {
        $sy = new SchoolYear();

        $sys = SchoolYear::orderBy('created_at')->pluck('id');

        if ($sys->isNotEmpty()) {
            $lastId = $sys->last();

            $number = str_pad($lastId + 1, 8, '1', STR_PAD_LEFT);
        } else {

            $number = str_pad(1, 8, '0', STR_PAD_LEFT);
        }

        $request->validate([
            'school_year' => ['required', Rule::unique('school_years', 'school_year')]
        ]);



        $sy->school_year = $request->school_year;
        $sy->unique_id = $number;
        $sy->save();

        return redirect()->route('sy.create')->with('message', 'School Year added succesfully');
    }

    public function edit($id)
    {
        $sy = SchoolYear::findOrFail($id);

        return view('admin.sy.edit', compact('sy'));
    }

    public function update(Request $request, $id)
    {
        $sy = SchoolYear::findOrFail($id);

        $request->validate([
            'school_year' => ['required', Rule::unique('school_years')->ignore($sy->id)]
        ]);

        $sy->school_year = $request->school_year;
        $sy->save();

        return redirect()->route('sy.index')->with('message', 'School Year updated succesfully');
    }

    public function destroy($id)
    {
        SchoolYear::findOrFail($id)->delete();

        return redirect()->route('sy.index')->with('message', 'School Year deleted succesfully');
    }
}
