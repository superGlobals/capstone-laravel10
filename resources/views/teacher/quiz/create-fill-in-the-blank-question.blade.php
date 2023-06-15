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
                        <h5 class="card-header-title">Create Fill in the Blank Questions</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.store-fill-in-the-blank-questions') }}" method="POST">
                            @csrf
                            @for ($i = 1; $i <= $numberOfQuestions; $i++)
                                <div class="mb-3">
                                    <label for="" class="form-label">Question # {{ $i }}</label>
                                    <input type="text" name="questions[{{ $i }}][question]"
                                        class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Answer for Question #
                                        {{ $i }}</label>
                                    <input type="text" name="questions[{{ $i }}][answer]" class="form-control"
                                        required>
                                </div>
                            @endfor
                            <input type="hidden" name="quiz_id" value="{{ $id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
