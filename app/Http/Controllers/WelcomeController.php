<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Info;

class WelcomeController extends Controller
{
    //
    public function index(){
        $beritas = Berita::OrderBy('updated_at','desc')->get();
        $infos = Info::OrderBy('updated_at','desc')->get();
        return view('welcome',compact('beritas','infos'));
    }
}
