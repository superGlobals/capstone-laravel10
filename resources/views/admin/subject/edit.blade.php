@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Subjects</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Subjects</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <a href="{{ route('subject.index') }}" class="btn btn-primary float-end">Back</a>
                        <h5 class="card-header-title">Edit Subject</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('subject.update', $subject->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label">Subject Code</label>
                                <input type="text" name="subject_code" value="{{ $subject->subject_code }}" class="form-control">
                                @error('subject_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Subject Title</label>
                                <input type="text" name="subject_title" value="{{ $subject->subject_title }}" class="form-control">
                                @error('subject_title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update Subject</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
