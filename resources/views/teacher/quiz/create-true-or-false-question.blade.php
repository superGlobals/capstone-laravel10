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
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="float-end">
                            <a href="{{ route('quiz.quiz-question', $id) }}" class="btn btn-primary">Back</a>
                        </div>
                        <h5 class="card-header-title">Create True or False Questions</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.store-true-or-false-quiz-questions') }}" method="POST">
                            @csrf

                            @for ($i = 1; $i <= $numQuestions; $i++)
                                <div class="mb-3">
                                    <label for="question_{{ $i }}" class="form-label">Question
                                        {{ $i }}:</label>
                                    <input type="text" class="form-control" id="question_{{ $i }}"
                                        name="questions[{{ $i }}][question]" required>
                                </div>

                                <div class="mb-3">
                                    <label for="answer_{{ $i }}" class="form-label">Answer
                                        {{ $i }}:</label>
                                    <select class="form-select" id="answer_{{ $i }}"
                                        name="questions[{{ $i }}][answer]" required>
                                        <option value="">Select answer for question # {{ $i }}</option>
                                        <option value="true">True</option>
                                        <option value="false">False</option>
                                    </select>
                                </div>
                            @endfor
                            <input type="hidden" name="quiz_id" value="{{ $id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit Questions</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
