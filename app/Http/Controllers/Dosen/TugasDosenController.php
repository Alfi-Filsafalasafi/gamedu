<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Models\User;
use App\Models\LogSubBabUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TugasDosenController extends Controller
{
    //
    public function bab(){
        $datas = Bab::withCount(['logSubBabUsers as jumlah_tugas' => function($query) {
            $query->where('status_tugas', 'submit');
        }])->orderBy('index', 'asc')->get();
    //     $datas = SubBab::where('id_bab', $id_bab)
    // ->leftJoin('log_sub_bab_user', 'sub_babs.id', '=', 'log_sub_bab_user.id_sub_bab')
    // ->select('sub_babs.*', DB::raw('COUNT(log_sub_bab_user.id) as jumlah_tugas'))
    // ->where('log_sub_bab_user.status_tugas', 'submit')
    // ->groupBy('sub_babs.id')
    // ->orderBy('sub_babs.index', 'asc')
    // ->get();
        return view('pages.dosen.tugas.materi', compact('datas'));
    }

    public function sub_bab($id_bab){
        $bab= Bab::findOrFail($id_bab);
        // $datas = SubBab::where('id_bab', $id_bab)->orderBy('index', 'asc')->get();
        $datas = SubBab::withCount(['logSubBabUsers as jumlah_tugas' => function($query){
                $query->where('status_tugas', 'submit');
                }])->where('id_bab', $id_bab)->orderBy('index', 'asc')->get();
        $membaca = SubBab::where('id_bab', $id_bab)->sum('point_membaca');
        $menonton_yt = SubBab::where('id_bab', $id_bab)->sum('point_menonton_yt');
        $tugas = SubBab::where('id_bab', $id_bab)->sum('point_tugas');
        $total_point = $membaca + $menonton_yt + $tugas;

        return view('pages.dosen.tugas.sub_bab', compact('bab', 'datas', 'total_point'));
    }

    public function pengumpulan($id_bab, $id){
        $bab = Bab::findOrFail($id_bab);
        $sub_bab = SubBab::findOrFail($id);
        $datas = User::leftJoin('log_sub_bab_users', function($join) use ($id) {
            $join->on('users.id', '=', 'log_sub_bab_users.id_user')
                 ->where('log_sub_bab_users.id_sub_bab', '=', $id)
                 ->orWhereNull('log_sub_bab_users.id_sub_bab');
        })
        ->select('users.*', 'log_sub_bab_users.*')
        ->where('users.role', 'mahasiswa')
        ->where('users.id_dosen', Auth::id())
        ->get();
    
        $total_point = $sub_bab->point_membaca + $sub_bab->point_menonton_yt + $sub_bab->point_tugas;
        // dd($datas);

        return view('pages.dosen.tugas.pengumpulan', compact('datas', 'bab', 'sub_bab', 'total_point'));
    }

    public function respon($id_bab, $id_sub_bab, $id){
        $bab = Bab::findOrFail($id_bab);
        $sub_bab = SubBab::findOrFail($id);
        $data = LogSubBabUser::with('user')->findOrFail($id);
        
        $total_point = $sub_bab->point_membaca + $sub_bab->point_menonton_yt + $sub_bab->point_tugas;


        return view('pages.dosen.tugas.respon', compact('data', 'bab', 'sub_bab', 'total_point'));
    }

    public function submitRespon(Request $request, $id){
        try {
            $logSubBabUser = LogSubBabUser::findOrFail($id);
            $logSubBabUser->status_tugas = $request->status_tugas;
            $logSubBabUser->catatan_tugas = $request->catatan_tugas;

            $perubahanPoint = $request->point_tugas - $logSubBabUser->point_tugas;

            $logSubBabUser->point_tugas = $request->point_tugas;

            if($request->status_tugas == 'selesai'){
                $logSubBabUser->status = 'selesai';
            }else{
                $logSubBabUser->status = 'progress';
            }
            $logSubBabUser->save();

            $user = User::findOrFail($logSubBabUser->id_user);
            $user->uang = $user->uang + ($perubahanPoint);
            $user->save();

            //update jika tugas diterima
           
            alert()->success('Hore!','Data berhasil disimpan');
            return redirect()->route('dosen.tugas.pengumpulan',['id_bab' => $logSubBabUser->id_bab, 'id' => $logSubBabUser->id_sub_bab]);
            
        } catch (\Throwable $th) {
            //throw $th;
            alert()->error('Gagal!','Silahkan coba lagi');
            return back();

        }
        


        return view('pages.dosen.tugas.respon', compact('data', 'bab', 'sub_bab', 'total_point'));
    }
}
