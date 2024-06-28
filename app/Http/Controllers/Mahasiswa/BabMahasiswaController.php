<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;

use App\Models\User;
use App\Models\LogBabUser;
use App\Models\LogSubBabUser;
use Illuminate\Support\Facades\Auth;

function getBabWithStatus()
{
    $id_user = Auth::id();
    $babs = Bab::all();

    $logBabs = LogBabUser::where('id_user', $id_user)
        ->whereIn('id_bab', $babs->pluck('id'))
        ->get()
        ->keyBy('id_bab');

    $logSubBabs = LogSubBabUser::where('id_user', $id_user)
        ->whereIn('id_bab', $babs->pluck('id'))
        ->get()
        ->groupBy('id_bab');

    $babWithStatus = $babs->map(function ($bab) use ($logBabs, $logSubBabs) {
            $log = $logBabs->get($bab->id);
            $bab->status = $log ? $log->status : 'belumAda';

            $logSubBab = $logSubBabs->get($bab->id);
            $bab->total_point_membaca = $logSubBab ? $logSubBab->sum('point_membaca') : 0;
            $bab->total_point_menonton_yt = $logSubBab ? $logSubBab->sum('point_menonton_yt') : 0; 
            $bab->total_point_tugas = $logSubBab ? $logSubBab->sum('point_tugas') : 0;
            $bab->total_point_user = $bab->total_point_membaca +  $bab->total_point_menonton_yt + $bab->total_point_tugas;
           
            return $bab;
        });
        $babWithStatus = $babWithStatus->sortBy('index');
    return $babWithStatus;
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

        $id_user = Auth::id();

        $membaca_user = LogSubBabUser::where('id_user', $id_user)->sum('point_membaca');
        $menonton_yt_user = LogSubBabUser::where('id_user', $id_user)->sum('point_menonton_yt');
        $tugas_user = LogSubBabUser::where('id_user', $id_user)->sum('point_tugas');
        $total_point_user = $membaca_user + $menonton_yt_user + $tugas_user;
        return view('pages.mahasiswa.bab.index', compact('datas', 'total_point', 'total_point_user'));
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