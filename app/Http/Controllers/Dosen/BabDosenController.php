<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BabDosenController extends Controller
{
    //
    public function index(){
        $datas = Bab::with('subBabs')->where('id_dosen', Auth::id())->orderBy('index', 'asc')->get();
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
        // dd($request->thumbnail);
        $request->validate([
            'thumbnail' => 'required|max:2048',
        ]);
        try {
            $formData = $request->all();
            $fileName = time() . '_bab.' . $request->thumbnail->extension();
            $request->thumbnail->move(public_path('assets/img/bab'), $fileName);
            $pathPhoto = 'assets/img/bab/' . $fileName;
            $formData['thumbnail'] = $pathPhoto;
            // $fileName = time() . '_image.' . $request->thumbnail->extension();
            // $pathPhoto = $request->thumbnail->storeAs('public/bab', $fileName);
            // $formData['thumbnail'] = 'storage/bab/' . $fileName;
            $formData['id_dosen'] = Auth::id();
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
        if($data->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        return view('pages.dosen.bab.edit', compact('data'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'thumbnail' => 'nullable|max:2048',
        ]);
        try {
            $bab = Bab::findOrFail($id);
            $formData = $request->all();
            if($request->thumbnail){
                Storage::delete('public/bab/' . basename($bab->thumbnail));
                $fileName = time() . '_image.' . $request->thumbnail->extension();
                $pathPhoto = $request->thumbnail->storeAs('public/bab', $fileName);
                $formData['thumbnail'] = 'storage/bab/' . $fileName;
            }
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
            Storage::delete('public/bab/' . basename($bab->thumbnail));
            $bab->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.bab.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
