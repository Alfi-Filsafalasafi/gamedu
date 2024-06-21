<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;

class BabDosenController extends Controller
{
    //
    public function index(){
        $datas = Bab::orderBy('index', 'asc')->get();
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.dosen.bab.index', compact('datas'));
    }

    public function create(){
        return view('pages.dosen.bab.create');
    }

    public function show($id){

    }

    public function store(Request $request){
        try {
            $formData = $request->all();
            Bab::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('dosen.bab.index');
        } catch (\Exception $th) {
            return redirect()->route('dosen.bab.index')->with('gagal','Penambahan bab gagal karena'. $th->getMessage());
            //throw $th;
        }
    }

    public function edit($id) {
        $data = Bab::findOrFail($id);
        return view('pages.dosen.bab.edit', compact('data'));
    }
    
    public function update(Request $request, $id) {
        try {
            $bab = Bab::findOrFail($id);
            $formData = $request->all();
            $bab->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('dosen.bab.index');
        } catch (\Exception $th) {
            return redirect()->route('dosen.bab.index')->with('error', 'Update bab gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        try{
            $bab = Bab::findOrFail($id);
            $bab->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.bab.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
