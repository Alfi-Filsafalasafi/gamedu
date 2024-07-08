<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;

class BeritaController extends Controller
{
    //
    public function index($id){
        $data = Berita::with('admin')->findOrFail($id);
        $beritas = Berita::where('id','!=',$id)->get();
        return view('berita',compact('beritas','data'));
    }
}
