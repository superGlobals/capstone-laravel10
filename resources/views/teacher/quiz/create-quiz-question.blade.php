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
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="float-end">
                            <a href="{{ route('quiz.quiz-question', $quiz->id) }}" class="btn btn-primary">Back</a>
                        </div>
                        {{-- <h5 class="card-header-title">Question List</h5> --}}

                    </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.storeQuizQuestion') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">Question</label>
                                <textarea name="question" class="form-control" id=""></textarea>
                                @error('question')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Question Type</label>
                                <select name="question_type" id="question_type" class="form-select">
                                    <option value=""></option>
                                    @foreach (json_decode('{"multiple_choice":"Multiple Choice","fill_in_the_blank":"Fill in the Blank","true_or_false":"True or False"}', true) as $typeKey => $typeValue)
                                        <option value="{{ $typeKey }}">{{ $typeValue }}</option>
                                    @endforeach
                                </select>
                                @error('question_type')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div id="true_or_false_options" style="display: none;">
                                <label>
                                    <input type="radio" name="answer_tf" value="true" required\> True
                                </label>
                                <label>
                                    <input type="radio" name="answer_tf" value="false" required\> False
                                </label>
                            </div>

                            <div id="multiple_choice_options" class="row" style="display: none;">
                                <label class="form-label mb-3">
                                    A:
                                    <input type="radio" name="answer_1" value="A">
                                    <input type="text" class="form-control" required>
                                </label>
                                <label class="form-label mb-3">
                                    B:
                                    <input type="radio" name="answer_2" value="B">
                                    <input type="text" class="form-control" required>

                                </label>
                                <label class="form-label mb-3">
                                    C:
                                    <input type="radio" name="answer_3" value="C">
                                    <input type="text" class="form-control" required>

                                </label>
                                <label class="form-label mb-3">
                                    D:
                                    <input type="radio" name="answer_4" value="D">
                                    <input type="text" class="form-control" required>

                                </label>
                            </div>

                            <div id="fill_in_the_blank_options" style="display: none;">
                                <label>
                                    Answer: <input type="text" class="form-control" name="fill_in_the_blank_answer" id="fill_in_the_blank_answer" required>
                                  </label>
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Add Question</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const questionTypeSelect = document.getElementById('question_type');
        const trueOrFalseOptions = document.getElementById('true_or_false_options');
        const multipleChoiceOptions = document.getElementById('multiple_choice_options');
        const fillInTheBlankOptions = document.getElementById('fill_in_the_blank_options');

        questionTypeSelect.addEventListener('change', function() {
            if (questionTypeSelect.value === 'true_or_false') {
                trueOrFalseOptions.style.display = 'block';
                multipleChoiceOptions.style.display = 'none';
                fillInTheBlankOptions.style.display = 'none';
                trueOrFalseOptions.prop('required', true);
            } else if (questionTypeSelect.value === 'multiple_choice') {
                trueOrFalseOptions.style.display = 'none';
                multipleChoiceOptions.style.display = 'block';
                fillInTheBlankOptions.style.display = 'none';
                multipleChoiceOptions.prop('required', true);
            } else if (questionTypeSelect.value === 'fill_in_the_blank') {
                trueOrFalseOptions.style.display = 'none';
                multipleChoiceOptions.style.display = 'none';
                fillInTheBlankOptions.style.display = 'block';
                fillInTheBlankAnswerField.prop('required', true);
            } else {
                trueOrFalseOptions.style.display = 'none';
                multipleChoiceOptions.style.display = 'none';
                fillInTheBlankOptions.style.display = 'none';
            }

        });
    </script>

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
