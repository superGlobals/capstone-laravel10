@extends('frontpage.main')
@section('content')
    <div class="col-md-4 mx-auto">
        <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="{{ asset('images/poclogo1.png') }}" width="80" alt="">
            </a>
        </div><!-- End Logo -->
        <div class="card shadow border-0">
            <div class="card-header border-0 bg-white mt-3">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('teacher.storeTeacher') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="idNumber" class="form-label">ID Number</label>
                        <input type="text" name="id_number" class="form-control" id="idNumber" placeholder="e.g. ABC123">
                        @error('id_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="e.g. Tang Gol">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="e.g. tang.gol@example.com">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Choose a strong password" value="{{ old('password') }}">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-12">
                        <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                        <input type="text" name="password_confirmation" class="form-control" id="passwordConfirmation"
                            placeholder="Confirm your password">
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="col-12">
                        <p class="small mb-0">Already have an account? <a href="#staticBackdrop"
                                data-bs-toggle="modal">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
