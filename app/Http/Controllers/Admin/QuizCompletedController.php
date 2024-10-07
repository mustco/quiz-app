<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Success;
use App\Models\User;

use function PHPSTORM_META\map;

class QuizCompletedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::pluck('id');
        $quizzes = Quiz::whereHas('questions.answers', function($query) use ($users) {
                $query->whereIn('user_id',$users) ;
        })->get();
        // $userss = User::where();
        return view('pages.admin.completed_quizzes.index', ['quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
          $users = User::with(['answers' => function($query) use ($id) {
                $query->whereHas('question.quiz', function($q) use ($id) {
                    $q->where('id', $id);
                })->whereHas('success', function($q) {
                    $q->where('completed', 1);
                });
            }])->whereHas('answers.question.quiz', function($query) use ($id) {
                $query->where('id', $id);
            })->get();
    

        $quiz = Quiz::findOrFail($id);
    
        $userSuccess = $users->filter(function($user) {
            return $user->success->isNotEmpty();
        });
        // dd($userSuccess);
       

        $totalScore = $userSuccess->sum(function ($user) {
            return $user->answers->where('is_correct', true)->count();
        });
        // dd($totalScore);
        return view('pages.admin.completed_quizzes.show', [
            'users'=>$userSuccess, 
            'quiz' => $quiz,
        ]);
    }
    public function showByUserId(Request $request, $quiz_id, $id) {

        $answer = Answer::where('user_id',$id)->whereHas('question.quiz', function($query) use ($quiz_id) {
            $query->where('id', $quiz_id);
        })->get();
        $quizess = Quiz::where('id', $quiz_id)->with('questions.answers')->get();
        
     return view('pages.admin.completed_quizzes.showbyid',['quiz_name' => $request->form_quiz_name, 'quiz_desc'=>$request->form_quiz_desc, 'quiz' => $quizess]);   
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $success = Success::where('user_id', $id)->first();
        $success->delete();
        return redirect()->back();
    }
}
