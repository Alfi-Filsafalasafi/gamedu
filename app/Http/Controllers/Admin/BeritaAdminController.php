<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use File;
use Illuminate\Support\Facades\Auth;

class BeritaAdminController extends Controller
{
    public function index(){
        $datas = Berita::with('admin')->get();
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.admin.berita.index', compact('datas'));
    }
    public function create(){
        return view('pages.admin.berita.create');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'judul' => 'required',
            'photo' => 'required|max:2048',
        ]);
        try{
            $formData = $request->all();
            $fileName = time() . '_berita.' . $request->photo->extension();
            $request->photo->move(public_path('assets/img/berita'), $fileName);
            $pathPhoto = 'assets/img/berita/' . $fileName;
            $formData['photo'] = $pathPhoto;
            $formData['id_admin'] = Auth::id();
            Berita::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('admin.berita.index');
        }catch(\Exception $th){
            alert()->error('Gagal!','Data gagal ditambah, silahkan coba lagi'. $th->getMessage());
            return back();
        }

    }

    public function edit($id){
        $data = Berita::findOrFail($id);
        return view('pages.admin.berita.edit',compact('data'));
    }


    public function update(Request $request, $id){
        $validateData = $request->validate([
            'judul' => 'required',
            'photo' => 'nullable|max:2048',
        ]);
        try{
            $formData = $request->all();
            $find = Berita::findOrFail($id);
            if ($request->photo) {
                File::delete($find->photo);
                $fileName = time() . '_berita.' . $request->photo->extension();
                $request->photo->move(public_path('assets/img/berita'), $fileName);
                $pathPhoto = 'assets/img/berita/' . $fileName;
                $formData['photo'] = $pathPhoto;
            }
            $formData['id_admin'] = Auth::id();
            $find->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('admin.berita.index');
        }catch(\Exception $th){
            alert()->error('Gagal!','Data gagal ditambah, silahkan coba lagi');
            return back();
        }

    }

    public function delete($id)
    {
        try{
            $berita = Berita::findOrFail($id);
            File::delete($berita->photo);
            $berita->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('admin.user.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
