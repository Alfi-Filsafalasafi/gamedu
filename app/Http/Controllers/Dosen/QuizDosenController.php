<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizDosenController extends Controller
{
    
    public function index(){
        $datas = Quiz::with('bab')->where('id_dosen', Auth::id())->get();
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.dosen.quiz.index', compact('datas'));
    }

    public function create(){
        $babs = Bab::where('id_dosen',Auth::id())->orderBy('index', 'asc')->get();
        return view('pages.dosen.quiz.create', compact('babs'));
    }

    public function show($id){

    }

    public function store(Request $request){
        try {
            $check = Quiz::where('id_bab', $request->id_bab)->where('type', $request->type)->first();
            if($check){
                alert()->error("data sudah ada");
                return back();
            }
            $formData = $request->all();
            $formData['id_dosen'] = Auth::id();
            Quiz::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('dosen.quiz.index');
        } catch (\Exception $th) {
            return redirect()->route('dosen.quiz.index')->with('gagal','Penambahan bab gagal karena'. $th->getMessage());
            //throw $th;
        }
    }

    public function edit($id) {
        $data = Quiz::findOrFail($id);
        if($data->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        $babs = Bab::orderBy('index', 'asc')->get();

        return view('pages.dosen.quiz.edit', compact('data', 'babs'));
    }
    
    public function update(Request $request, $id) {
        try {
            $bab = Quiz::findOrFail($id);
            $formData = $request->all();
            $bab->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('dosen.quiz.index');
        } catch (\Exception $th) {
            return redirect()->route('dosen.quiz.index')->with('error', 'Update bab gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        try{
            $bab = Quiz::findOrFail($id);
            $bab->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.quiz.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
