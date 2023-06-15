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
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <a href="{{ route('student.enroll') }}" class="btn btn-primary float-end">Enroll to this Class</a>
                    <h4 class="fw-bold text-black fs-5">My Classmate</h4>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        
    </div>
@endsection
