<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Quiz;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuizQuestionValidationRequest;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizes = Quiz::orderBy('created_at')->get();
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

        return view('teacher.quiz.quiz-question', compact('quiz'));
    }

    public function createQuestion($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('teacher.quiz.create-quiz-question', compact('quiz'));
    }

    public function storeQuizQuestion(QuizQuestionValidationRequest $request)
    {
        dd($request);
    }
}
