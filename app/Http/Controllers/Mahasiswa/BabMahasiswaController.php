<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;

use App\Models\User;
use App\Models\LogBabUser;
use Illuminate\Support\Facades\Auth;

function getBabWithStatus()
{
    $userId = Auth::id();
    $babs = Bab::leftJoin('log_bab_users', function($join) use ($userId) {
            $join->on('babs.id', '=', 'log_bab_users.id_bab')
                 ->where('log_bab_users.id_user', '=', $userId);
        })
        ->select('babs.*', 'log_bab_users.status')
        ->orderBy('index', 'asc')
        ->get()
        ->map(function ($bab) {
            if (is_null($bab->status)) {
                $bab->status = 'belumAda';
            }
            return $bab;
        });

    return $babs;
}


class BabMahasiswaController extends Controller
{
    //
    public function index()
    {
        $datas = getBabWithStatus();

        $membaca = SubBab::sum('point_membaca');
        $menonton_yt = SubBab::sum('point_menonton_yt');
        $tugas = SubBab::sum('point_tugas');
        $total_point = $membaca + $menonton_yt + $tugas;
        return view('pages.mahasiswa.bab.index', compact('datas', 'total_point'));
    }

    public function beli($id){
        $user= User::findOrFail(Auth::id());
        $bab = Bab::findOrFail($id);
        if($user->uang < $bab->beli_point){
            alert()->error('Gagal','Point anda tidak mencukupi untuk membeli ini');
            return back();
        }else{
            try {
                $user = User::findOrFail($user->id);
                $user->uang = $user->uang - $bab->beli_point;
                $user->save();
                $log_bab = new LogBabUser();
                $log_bab->id_user = $user->id;
                $log_bab->id_bab = $bab->id;
                $log_bab->status = 'progress';
                $log_bab->save();
                alert()->success('Berhasil','Silahkan akses materi dan belajar dengan rajin');
                return back();
            } catch (\Throwable $th) {
                alert()->success('Gagal','Silahkan coba lagi');
                return back();
            }
        }
    }
}
