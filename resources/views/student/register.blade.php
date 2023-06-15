@extends('frontpage.main')
@section('content')
    <style>
        .input-group-append {
            position: relative;
        }

        .input-group-text {
            background-color: white;
            border: 0;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
        }

        .input-group-text:hover {
            color: blue;
        }
    </style>
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
                <form method="POST" action="{{ route('student.store-student') }}" class="row g-3">
                    @csrf
                    <div class="col-12">
                        <label for="idNumber" class="form-label">Student Number</label>
                        <input type="text" name="id_number" class="form-control" id="idNumber"
                            placeholder="e.g. PC18-XXX" value="{{ old('id_number') }}">
                        @error('id_number')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="e.g. Cardo Dalisay" value="{{ old('name') }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label">Choose Course Year & Section</label>
                        <select name="class_id" id="course-select" class="form-select">
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

                    <div class="col-12">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="email"
                            placeholder="e.g. cardo@example.com" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="passwordInput" class="form-control" placeholder="Password" value="{{ old('password') }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword">
                                    <i class="bi bi-eye-slash" id="passwordToggleIcon"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>


                    <div class="col-12">
                        <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="passwordInput2" class="form-control" placeholder="Confirm your password" value="{{ old('password_confirmation') }}">
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword2">
                                    <i class="bi bi-eye-slash" id="passwordToggleIcon2"></i>
                                </span>
                            </div>
                        </div>
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

    <script>
        const passwordInput = document.getElementById('passwordInput');
        const togglePassword = document.getElementById('togglePassword');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');

        togglePassword.addEventListener('click', function() {
            const passwordType = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', passwordType);

            passwordToggleIcon.classList.toggle('bi-eye-slash');
            passwordToggleIcon.classList.toggle('bi-eye');
        });
    </script>

    <script>
        const passwordInput2 = document.getElementById('passwordInput2');
        const togglePassword2 = document.getElementById('togglePassword2');
        const passwordToggleIcon2 = document.getElementById('passwordToggleIcon2');

        togglePassword2.addEventListener('click', function() {
            const passwordType = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput2.setAttribute('type', passwordType);

            passwordToggleIcon2.classList.toggle('bi-eye-slash');
            passwordToggleIcon2.classList.toggle('bi-eye');
        });
    </script>
@endsection
