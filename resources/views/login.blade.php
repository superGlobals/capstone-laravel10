@extends('frontpage.main')
@section('content')
    <div class="col-md-4 mx-auto mt-3">
        <div class="d-flex justify-content-center py-4">
            <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="{{ asset('images/poclogo1.png') }}" width="80" alt="">
            </a>
        </div><!-- End Logo -->
        <div class="card shadow border-0">
            <div class="card-header border-0 bg-white mt-3">
                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                <p class="text-center small">Enter your email &amp; password to login</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('teacher-student-auth') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="yourUsername" class="form-label">Email</label>

                        <input type="text" name="email" class="form-control" id="yourUsername">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror

                    </div>

                    <div class="col-12">
                        <label for="yourPassword" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="yourPassword">
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                    <div class="col-12">
                        <p class="small mb-0">Don't have account? <a href="#staticBackdrop" data-bs-toggle="modal">Create an
                                account</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose user type:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3">
                            <a href="" class="btn btn-warning" style="width: 100%; padding: 10px">I'm a Student</a>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('teacher.register') }}" class="btn btn-primary" style="width: 100%; padding: 10px">I'm a Teacher</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
