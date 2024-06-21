<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeDosenController extends Controller
{
    //
    public function index()
    {
        return view('pages.dosen.home');
    }
}
