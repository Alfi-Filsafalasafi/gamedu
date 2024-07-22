<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Helpers\TimeHelper;
use Illuminate\Support\Facades\Auth;
use File;
use Illuminate\Auth\Events\Validated;

class SubBabDosenController extends Controller
{
    //
    public function index($id_bab){
        $datas = SubBab::where('id_bab', $id_bab)->orderBy('index', 'asc')->get();
        $bab = Bab::findOrFail($id_bab);
        if($bab->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.dosen.sub_bab.index', compact('datas', 'bab'));
    }

    public function create($id_bab){
        $bab = Bab::findOrFail($id_bab);
        if($bab->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        return view('pages.dosen.sub_bab.create', compact('bab'));
    }

    public function show($id_bab, $id) {
        $data = SubBab::findOrFail($id);
        $bab = Bab::findOrFail($id_bab);
        if($bab->id_dosen != Auth::id() || $data->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        
        $data->min_akses_materi = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_materi);
        $data->min_akses_yt = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_yt);
        return view('pages.dosen.sub_bab.show', compact('data', 'bab'));

    }

    public function store(Request $request, $id_bab){
        try {
            $formData = $request->all();
            if($request->lampiran_pdf){
                $fileName = time() . '_bab_' . $id_bab .  '_materi.' . $request->lampiran_pdf->extension();
                $request->lampiran_pdf->move(public_path('assets/materi'), $fileName);
                $path = 'assets/materi/' . $fileName;
                $formData['lampiran_pdf'] = $path;
            }
            $formData['id_bab'] = $id_bab;
            $formData['id_dosen'] = Auth::id();
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
        if($bab->id_dosen != Auth::id() || $data->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        return view('pages.dosen.sub_bab.edit', compact('data', 'bab'));
    }
    
    public function update(Request $request, $id_bab, $id) {
        try {
            $bab = SubBab::findOrFail($id);
            $formData = $request->all();
            if($request->lampiran_pdf){
                File::delete($bab->lampiran_pdf);
                $fileName = time() . '_bab_' . $id_bab .  '_materi.' . $request->lampiran_pdf->extension();
                $request->lampiran_pdf->move(public_path('assets/materi'), $fileName);
                $path = 'assets/materi/' . $fileName;
                $formData['lampiran_pdf'] = $path;
            }
            $bab->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab]);
        } catch (\Exception $th) {
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab])->with('error', 'Update Sub Bab gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id_bab, $id)
    {
        try{
            $bab = SubBab::findOrFail($id);
            $bab->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.sub_bab.index',['id_bab' => $id_bab])->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
