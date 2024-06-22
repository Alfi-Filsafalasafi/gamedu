<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Models\LogBabUser;
use App\Models\LogSubBabUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function getSubBabWithStatus($id_bab, $id_user) {
    $subBabs = SubBab::where('id_bab', $id_bab)->get();

    $logSubBabs = LogSubBabUser::where('id_user', $id_user)
        ->whereIn('id_sub_bab', $subBabs->pluck('id'))
        ->get()
        ->keyBy('id_sub_bab');

    $subBabsWithStatus = $subBabs->map(function ($subBab) use ($logSubBabs) {
        $log = $logSubBabs->get($subBab->id);
        $subBab->status = $log ? $log->status : 'belumAda';
        return $subBab;
    });

    return $subBabsWithStatus;
}

class SubBabMahasiswaController extends Controller
{
    //

    public function index($id_bab){

        $userId = auth()->id(); // Mengambil ID user yang sedang login
        $logBabUser = LogBabUser::where('id_bab', $id_bab)
                                ->where('id_user', $userId)
                                ->first();

        if (!$logBabUser) {
            return view('pages.404'); // Melempar exception jika tidak ditemukan log_bab_user
        }
        // $datas = SubBab::where('id_bab', $id_bab)->orderBy('index', 'asc')->get();
        $datas = getSubBabWithStatus($id_bab, $userId);
        // dd($datas);
        $bab = Bab::findOrFail($id_bab);


        $membaca = SubBab::where('id_bab', $id_bab)->sum('point_membaca');
        $menonton_yt = SubBab::where('id_bab', $id_bab)->sum('point_menonton_yt');
        $tugas = SubBab::where('id_bab', $id_bab)->sum('point_tugas');
        $total_point = $membaca + $menonton_yt + $tugas;
        return view('pages.mahasiswa.sub_bab.index', compact('datas', 'bab', 'total_point'));
    }

    public function baca($id_bab, $id){
        $userId = auth()->id();
        $logBabUser = LogSubBabUser::where('id_bab', $id_bab)
                                ->where('id_sub_bab', $id)
                                ->where('id_user', $userId)
                                ->first();

        if (!$logBabUser) {
            return view('pages.404'); // Melempar exception jika tidak ditemukan log_bab_user
        }
        $data = SubBab::findOrFail($id);
        $bab = Bab::findOrFail($id_bab);
        return view('pages.mahasiswa.sub_bab.baca', compact('data', 'bab'));
    }

    public function beli($id_bab, $id){
        $user= User::findOrFail(Auth::id());
        $bab = Bab::findOrFail($id_bab);
        $sub_bab = SubBab::findOrFail($id);
        if($user->uang < $sub_bab->beli_point){
            alert()->error('Gagal','Point anda tidak mencukupi untuk membeli ini');
            return back();
        }else{
            try {
                $user = User::findOrFail($user->id);
                $user->uang = $user->uang - $sub_bab->beli_point;
                $user->save();
                $log_sub_bab = new LogSubBabUser();
                $log_sub_bab->id_user = $user->id;
                $log_sub_bab->id_bab = $bab->id;
                $log_sub_bab->id_sub_bab = $sub_bab->id;
                $log_sub_bab->status = 'progress';
                $log_sub_bab->save();
                alert()->success('Berhasil','Silahkan akses materi dan belajar dengan rajin');
                return back();
            } catch (\Throwable $th) {
                alert()->success('Gagal','Silahkan coba lagi');
                return back();
            }
        }
    }
}
