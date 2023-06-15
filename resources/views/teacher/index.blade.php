@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>School Year: {{ App\Models\SchoolYear::latest()->value('school_year') }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Class</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <h4 class="fw-bold text-black fs-5">My Class</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($ownClasses as $ownClass)
                            <div class="col-md-6">
                                <a href="{{ route('teacher.my-students', $ownClass->unique_id) }}">
                                    <div class="card shadow">
                                        <div class="card-header bg-primary">

                                        </div>
                                        <div class="card-body text-center p-4">
                                            <h3>{{ strtoupper($ownClass->class->course . '-' . $ownClass->class->year . $ownClass->class->section) }}
                                            </h3>
                                            <span>{{ strtoupper($ownClass->subject->subject_code) }}</span>
                                            <br>
                                            <small
                                                class="text-muted">{{ strtoupper($ownClass->subject->subject_title) }}</small>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @empty
                            <h3 class="text-center">No Class Found</h3>
                        @endforelse
                    </div>
                    {{ $ownClasses->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-header border-0 bg-white">
                    <h4 class="fw-bold text-black fs-5">Add New Class</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('teacher.storeClass') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Class Name</label>
                            <select name="class_id" id="course-select" class="form-select" required>
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">
                                        {{ strtoupper($class->course . '-' . $class->year . $class->section) }}</option>
                                @endforeach
                            </select>
                            @error('class_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Subject</label>
                            <select name="subject_id" id="subject-select" class="form-select" required>
                                <option value="">Select Subject</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">
                                        {{ strtoupper($subject->subject_code) . ' ' . ucwords($subject->subject_title) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Student Limit</label>
                            <input type="number" class="form-control" name="student_limit" placeholder="Maximum number of students that can enroll" required>
                            @error('student_limit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Class</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
