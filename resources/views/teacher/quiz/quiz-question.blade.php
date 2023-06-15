@extends('layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Quiz Question</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Home</a></li>
                <li class="breadcrumb-item active">Quiz Question</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="float-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#trueOrFalse">
                                Create True or False
                            </button>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#fillInTheBlank">
                                Create Fill in the Blank
                            </button>

                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#multipleChoice">
                                Create Multiple Choice
                            </button>
                            {{-- <a href="{{ route('quiz.create-question', $quiz->id) }}" class="btn btn-primary">Add Question</a> --}}
                        </div>
                        <h5 class="card-header-title">Question List</h5>

                    </div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Question</th>
                                    <th scope="col">Question Type</th>
                                    <th scope="col">Answer</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ ucwords($question->question) }}</td>
                                        <td>{{ haha($question->question_type) }}</td>
                                        <td>{{ ucwords($question->answer) }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal for selecting the number of questions in true or false-->
    <div id="trueOrFalse" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('quiz.store-true-or-false-quiz-number', $quiz->id) }}">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Number of Questions For True or False</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="">
                            <label for="num_questions" class="form-label">Number of Questions:</label>
                            <input type="number" class="form-control" id="num_questions" name="num_questions" required>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Proceed to making questions</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for selecting the number of questions in fill in the blank-->
    <div id="fillInTheBlank" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('quiz.store-fill-in-the-blank-quiz-number', $quiz->id) }}">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Number of Questions For Fill in the Blank</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="">
                            <label for="num_questions" class="form-label">Number of Questions:</label>
                            <input type="number" class="form-control" id="num_questions" name="num_questions" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Proceed to making questions</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for selecting the number of questions in multiple choice-->
    <div id="multipleChoice" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('quiz.store-multiple-choice-quiz-number', $quiz->id) }}">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Number of Questions For Multiple Choice</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf

                        <div class="">
                            <label for="num_questions" class="form-label">Number of Questions:</label>
                            <input type="number" class="form-control" id="num_questions" name="num_questions" required>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-primary">Proceed to making questions</button>
                    </div>
                </div>
            </form>
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
