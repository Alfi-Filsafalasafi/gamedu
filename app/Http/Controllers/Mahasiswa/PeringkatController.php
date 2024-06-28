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
    public static function calculateRank(){
        $id_user = Auth::id();
        $user = User::findOrFail($id_user);
        $peringkatController = new PeringkatController();
        $pointLogSubBab = $peringkatController->pointLogSubBab();
        $pointQuiz = $peringkatController->pointQuiz();

        $combinedPoints = $pointLogSubBab->map(function($logSubBabUser) use ($pointQuiz) {
            $quizUser = $pointQuiz->firstWhere('id', $logSubBabUser->id);
            $logSubBabUser->total_points = ($logSubBabUser->total_points ?? 0) + ($quizUser->total_points ?? 0);
            return $logSubBabUser;
        });

        $combinedPoints = $combinedPoints->sortByDesc('total_points')->values();

        return $pointLogSubBab;

    }


    protected function pointLogSubBab(){
       $pointLogSubBab = User::leftJoin('log_sub_bab_users', 'users.id', '=', 'log_sub_bab_users.id_user')
       ->select('users.id', 'users.name', 'users.role',
       DB::raw('SUM(COALESCE(log_sub_bab_users.point_tugas, 0) + COALESCE(log_sub_bab_users.point_membaca, 0) + COALESCE(log_sub_bab_users.point_menonton_yt, 0)) as total_points'))
       ->where('users.role', 'mahasiswa')
       ->groupBy('users.id', 'users.name', 'users.role')
       ->orderBy('total_points', 'desc')
       ->get();
        
        return $pointLogSubBab;
    }

    protected function pointQuiz(){
        $pointQuiz =  User::leftJoin('quiz_pengumpulans', 'users.id', '=', 'quiz_pengumpulans.id_user')
        ->select('users.id', 'users.name', 'users.role', DB::raw('COUNT(CASE WHEN quiz_pengumpulans.is_benar = 1 THEN 1 END) * 10 AS total_points'))
        ->where('users.role', 'mahasiswa')
        ->groupBy('users.id', 'users.name', 'users.role')
        ->orderBy('total_points', 'desc')
         ->get();
         
         return $pointQuiz;
    }
}
