@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>School Year: {{ App\Models\SchoolYear::latest()->value('school_year') }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Classqwe</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <a href="{{ route('student.enroll') }}" class="btn btn-primary float-end">Enroll to your Class</a>
                    <h4 class="fw-bold text-black fs-5">My Class</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($myClasses as $class)
                            <div class="col-md-4">
                                <a href="">
                                    <div class="card shadow">
                                        <div class="card-header bg-primary p-0 px-2">
                                            <h6 class="text-white mt-2 fw-bold">Professor: {{ ucwords($class->teacher_name) }}</h6>
                                        </div>
                                        <div class="card-body text-center p-4">
                                            <h3>{{ strtoupper($class->course . '-' . $class->year . $class->section) }}
                                            </h3>
                                            <span>{{ strtoupper($class->subject_code) }}</span>
                                            <br>
                                            <small
                                                class="text-muted">{{ strtoupper($class->subject_title) }}</small>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        @empty
                            <h3 class="text-center">No Class Found</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
