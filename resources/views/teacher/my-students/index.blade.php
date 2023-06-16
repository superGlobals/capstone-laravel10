@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>School Year: {{ App\Models\SchoolYear::latest()->value('school_year') }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">My Class</a></li>
                <li class="breadcrumb-item active">{{ strtoupper($teacherClass->class->course . '-' . $teacherClass->class->year . $teacherClass->class->section) }}</li>
                <li class="breadcrumb-item active">{{ strtoupper($teacherClass->subject->subject_code) }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <h4 class="fw-bold text-black fs-5">My Students</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($myStudents as $myStudent)
                            <div class="col-md-2">
                                <div class="card border-0">
                                    <div class="card-header p-2" style="">
                                        <img src="{{ asset('images/default.jpg') }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body p-0 text-center">
                                        <p class="fw-bold mt-1">{{ $myStudent->student_name }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        <h3 class="text-center">No Student Found</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
