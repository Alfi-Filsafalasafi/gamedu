<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        if(Auth::user()->role == 'mahasiswa'){
            return redirect()->route('mahasiswa.index');
        }elseif(Auth::user()->role == 'dosen'){
            return redirect()->route('dosen.index');
        }elseif(Auth::user()->role == 'admin'){
            return redirect()->route('admin.index');
        }
    }
}
