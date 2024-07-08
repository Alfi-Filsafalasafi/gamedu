<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use File;

class UserAdminController extends Controller
{
    //
    public function index(){
        $datas = User::with('dosen')->get();
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.admin.user.index', compact('datas'));
    }

    public function create(){
        $dosens = User::where('role', 'dosen')->get();
        return view('pages.admin.user.create',compact('dosens'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);
        try {
            $formData = $request->all();
            $formData['password'] = Hash::make($request->password);
            if($request->role == 'dosen'){
                do {
                    $token = substr(md5(uniqid(mt_rand(), true)), 0, 6);
                } while (User::where('token_dosen', $token)->exists());
                $formData['token_dosen'] = $token;
                $formData['id_dosen'] = null;
            }elseif($request->role == 'admin'){
                $formData['id_dosen'] = null;
            }
            User::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('admin.user.index');
        } catch (\Exception $th) {
            return redirect()->route('admin.user.index')->with('success','Penambahan akun gagal karena'. $th->getMessage());
            //throw $th;
        }
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $dosens = User::where('role', 'dosen')->get();

        return view('pages.admin.user.edit', compact('user', 'dosens'));
    }
    
    public function update(Request $request, $id) {
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);
    
        try {
            $user = User::findOrFail($id);
            $formData = $request->all();
            if ($request->filled('password')) {
                $formData['password'] = Hash::make($request->password);
            } else {
                unset($formData['password']);
            }
            if($request->role == 'mahasiswa'){     
                $formData['token_dosen'] = null;
            }elseif($request->role == 'dosen'){
                do {
                    $token = substr(md5(uniqid(mt_rand(), true)), 0, 6);
                } while (User::where('token_dosen', $token)->exists());
                $formData['token_dosen'] = $token;
                $formData['id_dosen'] = null;
            }else{
                $formData['token_dosen'] = null;
                $formData['id_dosen'] = null;
            }
            $user->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('admin.user.index');
        } catch (\Exception $th) {
            return redirect()->route('admin.user.index')->with('error', 'Update akun gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('admin.user.index')->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
    
}
