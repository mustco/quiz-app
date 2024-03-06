<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;

use function Laravel\Prompts\alert;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::all();
        
        return view('pages.admin.quizzes.index', ['quizzes' => $quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Quiz::create($data);
        return redirect()->route('kuis.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $quiz = Quiz::find($id);
        $data = Quiz::with('questions')->get();
        // dd($quiz->questions());
        return view('pages.admin.quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $quiz = Quiz::find($uuid);
        
        return view('pages.admin.quizzes.edit', ['quiz' => $quiz]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'quiz_name' => 'required|string',
            'description' => 'required|string'
        ]);

        $quiz = $request->all();
        $quiz_id = Quiz::findOrFail($id);
        $quiz_id->update($quiz);

        return redirect()->route('kuis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        // dd($quiz);
        $quiz->delete();

        return redirect()->route('kuis.index');
    }
}
