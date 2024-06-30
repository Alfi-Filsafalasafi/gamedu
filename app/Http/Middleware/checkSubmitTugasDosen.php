<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LogSubBabUser;
class checkSubmitTugasDosen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'dosen') {
            $jumlahTugas = LogSubBabUser::where('status_tugas', 'submit')->count();
            view()->share('jumlahTugas', $jumlahTugas);
        }
        return $next($request);
    }
}
