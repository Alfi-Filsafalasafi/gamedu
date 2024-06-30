<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\LogSubBabUser;

class checkRevisiTugasMahasiswa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role == 'mahasiswa') {
            $jumlahRevisi = LogSubBabUser::where('status_tugas', 'revisi')->where('id_user', Auth::id())->count();
            view()->share('jumlahRevisi', $jumlahRevisi);
        }
        return $next($request);
    }
}
