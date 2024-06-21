<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Helpers\TimeHelper;

class SubBabDosenController extends Controller
{
    //
    public function index($id_bab){
        $datas = SubBab::where('id_bab', $id_bab)->orderBy('index', 'asc')->get();
        $bab = Bab::findOrFail($id_bab);
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.dosen.sub_bab.index', compact('datas', 'bab'));
    }

    public function create($id_bab){
        $bab = Bab::findOrFail($id_bab);
        return view('pages.dosen.sub_bab.create', compact('bab'));
    }

    public function show($id_bab, $id) {
        $data = SubBab::findOrFail($id);
        $bab = Bab::findOrFail($id_bab);
        
        $data->min_akses_materi = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_materi);
        $data->min_akses_yt = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_yt);
        return view('pages.dosen.sub_bab.show', compact('data', 'bab'));

    }

    public function store(Request $request, $id_bab){
        try {
            $formData = $request->all();
            $formData['id_bab'] = $id_bab;
            SubBab::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab]);
        } catch (\Exception $th) {
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab])->with('error','Penambahan Sub Bab gagal karena'. $th->getMessage());
            //throw $th;
        }
    }

    public function edit($id_bab, $id) {
        $data = SubBab::findOrFail($id);
        $bab = Bab::findOrFail($id_bab);
        return view('pages.dosen.sub_bab.edit', compact('data', 'bab'));
    }
    
    public function update(Request $request, $id_bab, $id) {
        try {
            $bab = SubBab::findOrFail($id);
            $formData = $request->all();
            $bab->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab]);
        } catch (\Exception $th) {
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab])->with('error', 'Update Sub Bab gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        try{
            $bab = SubBab::findOrFail($id);
            $bab->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.sub_bab.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
