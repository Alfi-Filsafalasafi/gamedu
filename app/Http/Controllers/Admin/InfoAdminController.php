<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Info;
use File;
use Illuminate\Support\Facades\Auth;

class InfoAdminController extends Controller
{
    //
    public function index(){
        $datas = Info::with('admin')->get();
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.admin.info.index', compact('datas'));
    }
    public function create(){
        return view('pages.admin.info.create');
    }
    public function store(Request $request){
        $validateData = $request->validate([
            'judul' => 'required',
            'photo' => 'required|max:2048',
        ]);
        try{
            $formData = $request->all();
            $fileName = time() . '_info.' . $request->photo->extension();
            $request->photo->move(public_path('assets/img/info'), $fileName);
            $pathPhoto = 'assets/img/info/' . $fileName;
            $formData['photo'] = $pathPhoto;
            $formData['id_admin'] = Auth::id();
            Info::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('admin.info.index');
        }catch(\Exception $th){
            alert()->error('Gagal!','Data gagal ditambah, silahkan coba lagi');
            return back();
        }

    }

    public function edit($id){
        $data = Info::findOrFail($id);
        return view('pages.admin.info.edit',compact('data'));
    }


    public function update(Request $request, $id){
        $validateData = $request->validate([
            'judul' => 'required',
            'photo' => 'nullable|max:2048',
        ]);
        try{
            $formData = $request->all();
            $find = Info::findOrFail($id);
            if ($request->photo) {
                File::delete($find->photo);
                $fileName = time() . '_info.' . $request->photo->extension();
                $request->photo->move(public_path('assets/img/info'), $fileName);
                $pathPhoto = 'assets/img/info/' . $fileName;
                $formData['photo'] = $pathPhoto;
            }
            $formData['id_admin'] = Auth::id();
            $find->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('admin.info.index');
        }catch(\Exception $th){
            alert()->error('Gagal!','Data gagal ditambah, silahkan coba lagi');
            return back();
        }

    }

    public function delete($id)
    {
        try{
            $info = Info::findOrFail($id);
            File::delete($info->photo);
            $info->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('admin.user.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
