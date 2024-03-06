<?php

namespace App\Http\Middleware;

use App\Models\Success;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class QuizSuccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Cek apakah pengguna sudah menyelesaikan kuis
       $completedData = Success::where('user_id', Auth::user()->id)->where('completed', true)->where('quiz_id', $request->quiz_id)->first();

       if (Auth::check() && $completedData) {
       return redirect()->route('kuis.berhasil', $request->quiz_id);
   //  dd($request->input('quiz_id'));

    //    return redirect('/');

       }
       return $next($request);

       // Jika belum menyelesaikan, arahkan ke halaman sukses

    }
}
