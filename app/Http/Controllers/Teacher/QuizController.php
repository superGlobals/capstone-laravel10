<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Quiz;
use Illuminate\Support\Str;
use App\Models\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuizQuestionValidationRequest;

class QuizController extends Controller
{
    public function index()
    {
        $quizes = Quiz::where('teacher_id', Auth::id())->orderBy('created_at')->get();
        return view('teacher.quiz.index', compact('quizes'));
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'quiz_title' => 'required',
            'quiz_description' => 'required',
        ]);

        Quiz::create([
            'quiz_title' => $request->quiz_title,
            'quiz_description' => $request->quiz_description,
            'teacher_id' => Auth::id(),
            'unique_id' => Str::random(32)
        ]);

        return redirect()->back()->with('message', 'Quiz added successfully');
    }

    public function quizQuestionList($id)
    {
        $quiz = Quiz::findOrFail($id);
        $questions = QuizQuestion::orderBy('created_at')->get();
        return view('teacher.quiz.quiz-question', compact('quiz', 'questions'));
    }

    public function createQuestion($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('teacher.quiz.create-quiz-question', compact('quiz'));
    }

    public function makeDynamicTrueOrFalseField(Request $request, $id)
    {
        $numQuestions = $request->input('num_questions');

        return view('teacher.quiz.create-true-or-false-question', compact('numQuestions', 'id'));
    }

    public function storeTrueOrFalseQuizQuestions(Request $request)
    {

        $questions = $request->input('questions');
        $id = $request->quiz_id;
        // dd($questions);
        // $answers = $request->input('answers');

        foreach ($questions as $question) {
            $quiz = new QuizQuestion();

            $quiz->question = $question['question'];
            $quiz->question_type = 'true_or_false';
            $quiz->answer = $question['answer'];
            $quiz->quiz_id = $id;
            $quiz->save();
        }

        return redirect()->route('quiz.quiz-question', $id)->with('message', 'Question added successfully');
    }

    public function makeDynamicMultipleChoiceField(Request $request, $id)
    {
        $numberOfQuestions = $request->input('num_questions');

        return view('teacher.quiz.create-multiple-choice-question', compact('numberOfQuestions', 'id'));
    }

    public function storeMultipleChoiceQuestions(Request $request)
    {
        $totalQuestion = $request->totalQuestion;
        $id = $request->quiz_id;

        for ($i = 1; $i <= $totalQuestion; $i++) {
            $quiz = new QuizQuestion();
            $quiz->question = $request->input("question_$i");
            $quiz->question_type = 'multiple_choice';
            $quiz->answer = $request->input("answer_$i");
            $quiz->quiz_id = $id;
            $quiz->save();

            $quizQuestionId = $quiz->id;

            $answerChoices = ['A', 'B', 'C', 'D'];

            foreach ($answerChoices as $choice) {
                $res = strtolower($choice);
                $answerText = $request->input("answer_{$i}_text_{$res}");

                DB::table('multiple_choice_answers')->insert([
                    'answer_text' => $answerText,
                    'choices' => $choice,
                    'quiz_question_id' => $quizQuestionId,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
        
        return redirect()->route('quiz.quiz-question', $id)->with('message', 'Question added successfully');
    }

    public function makeDynamicFillInTheBlankField(Request $request, $id)
    {
        $numberOfQuestions = $request->input('num_questions');

        return view('teacher.quiz.create-fill-in-the-blank-question', compact('numberOfQuestions', 'id'));
    }

    public function storeFillInTheBlankQuestions(Request $request)
    {
        $questions = $request->input('questions');
        $id = $request->quiz_id;

        foreach($questions as $question) {
            $quiz = new QuizQuestion();

            $quiz->question = $question['question'];
            $quiz->question_type = 'fill_in_the_blank';
            $quiz->answer = $question['answer'];
            $quiz->quiz_id = $id;
            $quiz->save();
        }

        return redirect()->route('quiz.quiz-question', $id)->with('message', 'Question added successfully');
    }
}
