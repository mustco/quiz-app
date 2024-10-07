<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index() {
        $quiz = Quiz::all();
        // dd(count($quiz));
        $user_count = User::where('roles', 'pengguna')->count();
        return view('pages.admin.dashboard', compact('quiz', 'user_count'));
    }   
}
