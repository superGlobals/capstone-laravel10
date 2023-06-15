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
                        <h5 class="card-header-title">Create Multiple Choice Questions</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.store-multiple-choice-questions') }}" method="POST">
                            @csrf
                            @for($i = 1; $i <= $numberOfQuestions; $i++)
                                <div class="mb-3">
                                    <h5>Question {{ $i }}</h5>
                                    <textarea class="form-control" name="question_{{ $i }}" required></textarea>
                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_{{ $i }}" id="answer_{{ $i }}_a" value="a" required>
                                        <label class="form-check-label" for="answer_{{ $i }}_a">A</label>
                                        <input class="form-control" type="text" name="answer_{{ $i }}_text_a" required>
                                    </div>
                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_{{ $i }}" id="answer_{{ $i }}_b" value="b" required>
                                        <label class="form-check-label" for="answer_{{ $i }}_b">B</label>
                                        <input class="form-control" type="text" name="answer_{{ $i }}_text_b" required>
                                    </div>
                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_{{ $i }}" id="answer_{{ $i }}_c" value="c" required>
                                        <label class="form-check-label" for="answer_{{ $i }}_c">C</label>
                                        <input class="form-control" type="text" name="answer_{{ $i }}_text_c" required>
                                    </div>
                    
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answer_{{ $i }}" id="answer_{{ $i }}_d" value="d" required>
                                        <label class="form-check-label" for="answer_{{ $i }}_d">D</label>
                                        <input class="form-control" type="text" name="answer_{{ $i }}_text_d" required>
                                    </div>
                                </div>
                                <input type="hidden" name="totalQuestion" value="{{ $i }}">

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
