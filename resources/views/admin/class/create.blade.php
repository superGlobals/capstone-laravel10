@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Class</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Class</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <a href="{{ route('class.index') }}" class="btn btn-primary float-end">Back</a>
                        <h5 class="card-header-title">Edit Class</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('class.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Course</label>
                                <input type="text" name="course" value="{{ old('course') }}" class="form-control">
                                @error('course')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Year</label>
                                <select name="year" id="" class="form-select">
                                    @foreach (json_decode('{"1":"1st Year","2":"2nd Year","3":"3rd Year","4":"4th Year"}', true) as $yearKey => $yearValue)
                                        <option value="{{ $yearKey }}">{{ $yearValue }}</option>
                                    @endforeach
                                </select>
                                @error('year')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Section</label>
                                <input type="text" name="section" value="{{ old('section') }}" class="form-control">
                                @error('section')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Class</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
