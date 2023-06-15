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
                        <h5 class="card-header-title">Create Question</h5>

                    </div>
                    <div class="card-body">
                        <form action="{{ route('quiz.storeQuizQuestion') }}" id="myForm" method="POST">
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
                                    <input type="radio" name="answer" value="true" /> True
                                </label>
                                <label>
                                    <input type="radio" name="answer" value="false" /> False
                                </label>
                            </div>

                            <div id="multiple_choice_options" class="row" style="display: none;">
                                <label class="form-label mb-3">
                                    A:
                                    <input type="radio" name="answer" value="A">
                                    <input type="text" name="answer_a" class="form-control">
                                </label>
                                <label class="form-label mb-3">
                                    B:
                                    <input type="radio" name="answer" value="B">
                                    <input type="text" name="answer_b" class="form-control">
                                </label>
                                <label class="form-label mb-3">
                                    C:
                                    <input type="radio" name="answer" value="C">
                                    <input type="text" name="answer_c" class="form-control">
                                </label>
                                <label class="form-label mb-3">
                                    D:
                                    <input type="radio" name="answer" value="D">
                                    <input type="text" name="answer_d" class="form-control">
                                </label>
                            </div>

                            <div id="fill_in_the_blank_options" class="row" style="display: none;">
                                <label class="">
                                    Answer: <input type="text" class="form-control" name="answer">
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
        const form = document.getElementById('myForm');
        const questionTypeSelect = document.getElementById('question_type');
        const trueOrFalseOptions = document.getElementById('true_or_false_options');
        const multipleChoiceOptions = document.getElementById('multiple_choice_options');
        const fillInTheBlankOptions = document.getElementById('fill_in_the_blank_options');

        form.addEventListener('submit', function(event) {
            const selectedType = questionTypeSelect.value;
            if (selectedType === 'true_or_false') {
                disableFields(multipleChoiceOptions);
                disableFields(fillInTheBlankOptions);
            } else if (selectedType === 'multiple_choice') {
                disableFields(trueOrFalseOptions);
                disableFields(fillInTheBlankOptions);
            } else if (selectedType === 'fill_in_the_blank') {
                disableFields(trueOrFalseOptions);
                disableFields(multipleChoiceOptions);
            }
        });

        questionTypeSelect.addEventListener('change', function() {
            trueOrFalseOptions.style.display = 'none';
            multipleChoiceOptions.style.display = 'none';
            fillInTheBlankOptions.style.display = 'none';

            const selectedType = questionTypeSelect.value;
            if (selectedType === 'true_or_false') {
                trueOrFalseOptions.style.display = 'block';
                setRequired(trueOrFalseOptions, true);
                clearFieldValues(multipleChoiceOptions);
                clearFieldValues(fillInTheBlankOptions);
                makeFieldNotRequired(fillInTheBlankOptions);
                makeFieldNotRequired(multipleChoiceOptions);
            } else if (selectedType === 'multiple_choice') {
                multipleChoiceOptions.style.display = 'block';
                setRequired(multipleChoiceOptions, true);
                clearFieldValues(trueOrFalseOptions);
                clearFieldValues(fillInTheBlankOptions);
                makeFieldNotRequired(fillInTheBlankOptions);
                makeFieldNotRequired(trueOrFalseOptions);
                
            } else if (selectedType === 'fill_in_the_blank') {
                fillInTheBlankOptions.style.display = 'block';
                setRequired(fillInTheBlankOptions, true);
                clearFieldValues(trueOrFalseOptions);
                clearFieldValues(multipleChoiceOptions);
                makeFieldNotRequired(multipleChoiceOptions);
                makeFieldNotRequired(trueOrFalseOptions);
            }
        });

        function setRequired(container, isRequired) {
            const inputElements = container.querySelectorAll('input');
            inputElements.forEach(function(element) {
                if (isRequired) {
                    element.setAttribute('required', '');
                } else {
                    element.removeAttribute('required');
                }
            });
        }

        function makeFieldNotRequired(container) {
        const inputElement = container.querySelector('input');
        inputElement.required = false;
    }

        function disableFields(container) {
            const inputElements = container.querySelectorAll('input');
            inputElements.forEach(function(element) {
                element.disabled = true;
            });
        }

        function clearFieldValues(container) {
        const inputElements = container.querySelectorAll('input');
        inputElements.forEach(function(element) {
            element.value = '';
        });
    }
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
