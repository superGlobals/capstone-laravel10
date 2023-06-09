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
                        <a href="{{ route('sy.index') }}" class="btn btn-primary float-end">Back</a>
                        <h5 class="card-header-title">Add School Year</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('sy.update', $sy->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="" class="form-label">School Year</label>
                                <input type="text" name="school_year" value="{{ old('school_year', $sy->school_year) }}" class="form-control">
                                @error('school_year')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update School Year</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
