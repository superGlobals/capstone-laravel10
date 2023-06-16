@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>School Year: {{ App\Models\SchoolYear::latest()->value('school_year') }}</h1>

        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">
                    {{ strtoupper($class->class->course . '-' . $class->class->year . $class->class->section) }}</li>
                <li class="breadcrumb-item active">{{ strtoupper($class->subject->subject_code) }}</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-header border-0">
                    <div class="float-end">
                        <form action="{{ route('student.enroll-to-class', $class) }}" method="POST">
                            @csrf
                            <button type="submit" onclick="enrollConfirm(event)" class="btn btn-danger">Enroll to this
                                class</button>
                        </form>
                    </div>
                    <h4 class="fw-bold text-black fs-5">Your Classmate</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($classmates as $classmate)
                            <div class="col-md-2">
                                <div class="card border-0">
                                    <div class="card-header p-2" style="">
                                        <img src="{{ asset('images/default.jpg') }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body p-0 text-center">
                                        <p class="fw-bold mt-1">{{ $classmate->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        window.enrollConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;

            Swal.fire({
                title: 'Enroll to this class ?',
                // text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, enroll now'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endsection
