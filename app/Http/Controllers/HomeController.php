<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use App\Models\Success;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\QuizSuccess;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Auth::logout();
        $quizzes = Quiz::orderBy('id', 'desc')->get();
        // dd($quizzes);
        return view('pages.home.home', ['quizzes' => $quizzes]);
    }

    public function detail($id) {
        $quiz = Quiz::find($id);

        return view('pages.home.detail', ['quiz' => $quiz]);
        
    }

    public function question($quiz_id, $question_id) {
        $question = Question::where('quiz_id', $quiz_id)->find($question_id);
        $answer_checked = Answer::where('user_id', Auth::user()->id)->where('question_id', $question_id)->pluck('answer')->first();
        // dd($answer_checked);
        $next_question = Question::where('quiz_id', $quiz_id)->where('id', '>', $question_id)->orderBy('id', 'asc')->first();
        // dd($next_question);
        // dd($quiz_id);
        if(Success::where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id)->first() == null) {
            Success::create([
                'user_id' => Auth::user()->id,
                'quiz_id' => $quiz_id,
            ]);
        } else {}
       
        return view('pages.home.pertanyaan', [
            'question' => $question,
            'quiz_id' => $quiz_id,
            'next_question' => $next_question,
            'answer_checked' => $answer_checked
            
        ]);
    }

    public function question_store(Request $request, $quiz_id, $question_id) {
        $question = Question::find($question_id);

        //mengecek apakah ada user dan pertanyaan sudah ada di database atau belum
        $answer_user_id = Answer::where('user_id', Auth::user()->id)->where('question_id', $question_id)->first();
        // dd($answer_user_id);
        
        //mengecek apakah jawaban berikutnya ada atau tidak
        $next_question = Question::where('quiz_id', $quiz_id)->where('id', '>', $question_id)->orderBy('id', 'asc')->first();
        // dd($next_question->id);

        $check_question_answer = Answer::where('user_id', Auth::user()->id)->pluck('answer')->toArray();
        
        if($answer_user_id && $next_question) {
            // dd(Auth::user());
       $completedData = Success::where('user_id', Auth::user()->id)->where('completed', true)->first();
    //    dd($completedData);
                $answer_update = Answer::find($answer_user_id)->first();
                $answer_update->update([
                    'answer' => $request->answer,
                    'is_correct' => $question->correct == $request->answer ? 'yes' : 'no'
                ]);
                return redirect()->route('kuis.pertanyaan', ['quiz_id' => $quiz_id, 'question_id' => $next_question->id]);
                // dd($next_question->id);
         
                // $check_question_answer = Answer::where('user_id', Auth::user()->id)->where('answer', null)->first();
                // if($check_question_answer) {
                //     return redirect()->back()->with('alert', 'Jawaban ada yang kosong!');
                // }else {
                // return redirect()->route('kuis.berhasil', $quiz_id);
                // }
        } else if($answer_user_id && !$next_question) {
            if(in_array(null, $check_question_answer)) {
                return redirect()->back()->with('alert', 'Jawaban tidak boleh kosong');
            } 
            $request->validate([
                'answer' => 'required'
            ], [
                'answer.required' => 'Jawaban tidak boleh kosong'
            ]);
            $answer_update = Answer::find($answer_user_id)->first();
            $answer_update->update([
                'answer' => $request->answer,
                'is_correct' => $question->correct == $request->answer ? 'yes' : 'no'

            ]);

            $success_quiz_id = Success::where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id)->first();
            $success_quiz_id->update([
                'user_id' => Auth::user()->id,
                'quiz_id' => $quiz_id,
                'completed' => true
            ]); 
          
            return redirect()->route('kuis.berhasil', $quiz_id);
        } else if(!$answer_user_id && $next_question) {
            
            Answer::create([
                'user_id' => Auth::user()->id,
                'question_id' => $question->id,
                'answer' => $request->answer,
                'is_correct' => $request->answer ? ($question->correct == $request->answer ? 'yes' : 'no') : null,
                'success_id' => Success::where('user_id', Auth::user()->id)->first()->id
            ]);
            return redirect()->route('kuis.pertanyaan', ['quiz_id' => $quiz_id, 'question_id' => $next_question->id]);
        }
        else if (!$answer_user_id && !$next_question) {
            if(in_array(null, $check_question_answer)) {
                return redirect()->back()->with('alert', 'Jawaban tidak boleh kosong');
            } 
            $request->validate([
                'answer' => 'required'
            ], [
                'answer.required' => 'Jawaban tidak boleh kosong'
            ]);
            Answer::create([
                'user_id' => Auth::user()->id,
                'question_id' => $question->id,
                'answer' => $request->answer,
                'is_correct' => $request->answer ? ($question->correct == $request->answer ? 'yes' : 'no') : null,
                'success_id' => Success::where('user_id', Auth::user()->id)->first()->id
            ]);
            $success_quiz_id = Success::where('user_id', Auth::user()->id)->where('quiz_id', $quiz_id)->first();
            $success_quiz_id->update([
                'user_id' => Auth::user()->id,
                'quiz_id' => $quiz_id,
                'completed' => true
            ]); 
          
         
                return redirect()->route('kuis.berhasil', $quiz_id);
            
        }
      
        // dd($next_question);
      

    }

    public function success($id) {
        $quiz = Quiz::find($id);
        $user_id = Auth::user()->id;



        $answer = Answer::where('user_id', $user_id)->whereHas('question', function($query) use ($id) {
            $query->where('quiz_id', $id);
        })->get();

        // hitung score berdasarkan jawaban yang benar
        $score = $answer->filter(function($answer) {
            return $answer->is_correct === 'yes';
        })->count();

        return view('pages.home.berhasil', [
            'quiz' => $quiz,
            'score' => $score
        ]);
    }
    public function berhasil() {
        return view('pages.home.berhasil');
    }
}
