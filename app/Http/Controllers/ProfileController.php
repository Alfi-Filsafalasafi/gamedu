<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;
use File;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function index(){
        return view('pages.profile');
    }

    public function updateProfile(Request $request){
        try{
            $find = User::findOrFail(Auth::id());
            $fullName = $find->name;
            $firstName = explode(' ', trim($fullName))[0];
            $formData = $request->all();
            if ($request->photo) {
                // Hapus file PDF lama dari folder public
                Storage::delete('public/profile/' . basename($find->photo));
                $fileNamePhoto = time() . '_' . $firstName . '_image.' . $request->photo->extension();
                $pathPhoto = $request->photo->storeAs('public/profile', $fileNamePhoto);
                $formData['photo'] = 'storage/profile/' . $fileNamePhoto;
            }
            $find->update($formData);

            return redirect()->route('profile.index')->with('success', 'Perubahan profil berhasil disimpan');
        }catch(\Exception $e){
            return redirect()->route('profile.index')->with('gagal', 'Perubahan profil gagal disimpan karena'.$e->getMessage());

        }
    }

public function updatePassword(Request $request)
{
    $user = auth()->user();

    if (!Hash::check($request->password, $user->password)) {
        return redirect()->route('profile.index')->withErrors(['password' => 'Password saat ini tidak cocok.']);
    }
    $request->validate([
        'password' => 'required',
        'newpassword' => 'required|min:8',
        'renewpassword' => 'required|same:newpassword',
    ], [
        'password.required' => 'Password saat ini harus diisi.',
        'newpassword.required' => 'Password baru harus diisi.',
        'newpassword.min' => 'Password baru minimal harus terdiri dari 8 karakter.',
        'renewpassword.required' => 'Konfirmasi password baru harus diisi.',
        'renewpassword.same' => 'Konfirmasi password baru tidak cocok.',
    ]);


    

    // Update password
    $user->password = Hash::make($request->newpassword);
    $user->save();

    return redirect()->route('profile.index')->with('success', 'Password berhasil diubah.');
}

}
