<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;

use App\Models\User;
use App\Models\LogBabUser;
use App\Models\LogSubBabUser;
use App\Models\QuizPengumpulan;
use App\Models\Quiz;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class PeringkatController extends Controller
{
    //
    public function index(){
        $id_user = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $user = User::findOrFail($id_user);
        $datas = $this->calculateRank($user->id_dosen);
        $userRank = null;
        foreach ($datas as $index => $data) {
            if ($data->id == $id_user) {
                $userRank = $index + 1; // Karena index dimulai dari 0, tambahkan 1 untuk mendapatkan peringkat sebenarnya
                break;
            }
        }
        $jumlahUser = $datas->count();
        return view('pages.mahasiswa.peringkat', compact('datas', 'userRank', 'jumlahUser'));
    }

    public function indexDosen(){
        $datas = $this->calculateRank(Auth::id());
        // dd($datas);
        $id_user = Auth::id(); // Mendapatkan ID pengguna yang sedang login
        $user = User::findOrFail($id_user);
        $userRank = null;
        foreach ($datas as $index => $data) {
            if ($data->id == $id_user) {
                $userRank = $index + 1; // Karena index dimulai dari 0, tambahkan 1 untuk mendapatkan peringkat sebenarnya
                break;
            }
        }
        $jumlahUser = $datas->count();
        return view('pages.dosen.peringkat', compact('datas', 'userRank', 'jumlahUser'));
    }

    public static function calculateRank($id_dosen){
        $id_user = Auth::id();
        $user = User::findOrFail($id_user);
        $peringkatController = new PeringkatController();
        $pointLogSubBab = $peringkatController->pointLogSubBab($id_dosen);
        $pointQuiz = $peringkatController->pointQuiz($id_dosen);

        $combinedPoints = $pointLogSubBab->map(function($logSubBabUser) use ($pointQuiz) {
            $quizUser = $pointQuiz->firstWhere('id', $logSubBabUser->id);
            $logSubBabUser->total_points = ($logSubBabUser->total_points ?? 0) + ($quizUser->total_points ?? 0);
            return $logSubBabUser;
        });

        $combinedPoints = $combinedPoints->sortByDesc('total_points')->values();

        // Mendapatkan peringkat pengguna yang sedang login
        $userRank = $combinedPoints->search(function($item) use ($id_user) {
            return $item->id == $id_user;
        });

        // Jika pengguna ditemukan, tambahkan informasi peringkat ke objek pengguna
        if ($userRank !== false) {
            $user->rank = $userRank + 1; // Karena array dimulai dari indeks 0, tambahkan 1 untuk mendapatkan peringkat sebenarnya
        } else {
            $user->rank = null; // Pengguna tidak ditemukan dalam peringkat
        }

        return $combinedPoints;

    }


    protected function pointLogSubBab($id_dosen){
       $pointLogSubBab = User::leftJoin('log_sub_bab_users', 'users.id', '=', 'log_sub_bab_users.id_user')
       ->select('users.id', 'users.name', 'users.role', 'users.photo', 'users.prodi', 'users.angkatan',
       DB::raw('SUM(COALESCE(log_sub_bab_users.point_tugas, 0) + COALESCE(log_sub_bab_users.point_membaca, 0) + COALESCE(log_sub_bab_users.point_menonton_yt, 0)) as total_points'))
       ->where('users.role', 'mahasiswa')
       ->where('users.id_dosen', $id_dosen)
       ->groupBy('users.id', 'users.name', 'users.role', 'users.photo', 'users.prodi', 'users.angkatan',)
       ->orderBy('total_points', 'desc')
       ->get();
        
        return $pointLogSubBab;
    }

    protected function pointQuiz($id_dosen){
        $pointQuiz =  User::leftJoin('quiz_pengumpulans', 'users.id', '=', 'quiz_pengumpulans.id_user')
        ->select('users.id', 'users.name', 'users.role', 'users.photo', 'users.prodi', 'users.angkatan',
         DB::raw('COUNT(CASE WHEN quiz_pengumpulans.is_benar = 1 THEN 1 END) * 10 AS total_points'))
        ->where('users.role', 'mahasiswa')
        ->where('users.id_dosen', $id_dosen)
        ->groupBy('users.id', 'users.name', 'users.role', 'users.photo', 'users.prodi', 'users.angkatan',)
        ->orderBy('total_points', 'desc')
         ->get();
         
         return $pointQuiz;
    }
}
