@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Quiz</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Quiz</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="float-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newQuiz">
                                New Quiz
                            </button>
                            <a href="{{ route('user.create') }}" class="btn btn-success">Upload Quiz to Class</a>
                        </div>
                        <h5 class="card-header-title">Quiz List</h5>

                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Quiz Title</th>
                                    <th scope="col">Quiz Description</th>
                                    <th scope="col">Quiz Questions</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($quizes as $quiz)
                                    <tr>
                                        <td>{{ ucwords($quiz->quiz_title) }}</td>
                                        <td>{{ ucwords($quiz->quiz_description) }}</td>
                                        <td><a href="{{ route('quiz.quiz-question', $quiz->id) }}" class="btn btn-secondary">Add Questions</a></td>
                                        <td>
                                            <div style="display: flex; gap: 10px;">
                                                <a href="" class="btn btn-success">Edit</a>
                                                <form action="" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="deleteConfirm(event)" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="newQuiz" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('quiz.storeQuiz') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Quiz</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="" class="form-label">Quiz Title</label>
                            <input type="text" name="quiz_title" id="" class="form-control">
                            @error('quiz_title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Quiz Description</label>
                            <textarea name="quiz_description" class="form-control" id=""></textarea>
                            @error('quiz_description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Quiz</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        window.deleteConfirm = function(e) {
            e.preventDefault();
            var form = e.target.form;

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endsection
