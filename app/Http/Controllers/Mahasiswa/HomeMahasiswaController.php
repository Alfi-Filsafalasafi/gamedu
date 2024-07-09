<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Models\SubQuiz;

use App\Models\User;
use App\Models\LogBabUser;
use App\Models\LogSubBabUser;
use App\Models\QuizPengumpulan;
use App\Models\Quiz;

use Illuminate\Support\Facades\Auth;

function getBabWithStatus()
{
    $id_user = Auth::id();
    $babs = Bab::where('id_dosen', Auth::user()->id_dosen)->get();

    $logBabs = LogBabUser::where('id_user', $id_user)
        ->whereIn('id_bab', $babs->pluck('id'))
        ->get()
        ->keyBy('id_bab');

    $logSubBabs = LogSubBabUser::where('id_user', $id_user)
        ->whereIn('id_bab', $babs->pluck('id'))
        ->get()
        ->groupBy('id_bab');
    $quiz = Quiz::whereIn('id_bab', $babs->pluck('id'))
        ->with(['subQuizs'])
        ->get()
        ->groupBy('id_bab');
        // dd($quiz);
        
    $quizPengumpulans = Quiz::whereIn('id_bab', $babs->pluck('id'))
        ->with(['quizPengumpulan' => function($query) use ($id_user) {
            $query->where('id_user', $id_user)->where('is_benar', 1);
        }])
        ->get()
        ->groupBy('id_bab');

    $babWithStatus = $babs->map(function ($bab) use ($logBabs, $logSubBabs, $quiz, $quizPengumpulans) {
            $log = $logBabs->get($bab->id);
            $bab->status = $log ? $log->status : 'belumAda';

            $logSubBab = $logSubBabs->get($bab->id);
            $quiz = $quiz->get($bab->id, collect());
            $bab->total_point_membaca = $logSubBab ? $logSubBab->sum('point_membaca') : 0;
            $bab->total_point_menonton_yt = $logSubBab ? $logSubBab->sum('point_menonton_yt') : 0; 
            $bab->total_point_tugas = $logSubBab ? $logSubBab->sum('point_tugas') : 0;

            // $bab->total_quiz = $quiz ? $quiz->subQuizs->count() : 0;
            $totalSubQuizzes = $quiz->sum(function($quiz) {
                return $quiz->subQuizs->count() * 10;
            });
        
            // Assign the total to the bab
            $bab->total_quiz = $totalSubQuizzes;
            // $bab->total_quiz = $bab->total_quiz * 10;

            $bab->jumlah_revisi = $logSubBab ? $logSubBab->where('status_tugas', 'revisi')->count() : 0;


            $quizPengumpulan = $quizPengumpulans->get($bab->id);
            $total_quiz_benar = 0;
            if ($quizPengumpulan) {
                foreach ($quizPengumpulan as $quiz) {
                    $total_quiz_benar += $quiz->quizPengumpulan->count() * 10;
                }
            }
            $bab->total_quiz_benar = $total_quiz_benar;

            $bab->total_point_user = $bab->total_point_membaca +  $bab->total_point_menonton_yt + $bab->total_point_tugas + $bab->total_quiz_benar;

            return $bab;
        });
        $babWithStatus = $babWithStatus->sortBy('index');
    return $babWithStatus;
}


class HomeMahasiswaController extends Controller
{
    //
    public function index()
    {
        $datas = getBabWithStatus();
        // dd($datas);
        $id_dosen =  Auth::user()->id_dosen;

        $membaca = SubBab::where('id_dosen',$id_dosen)->sum('point_membaca');
        $menonton_yt = SubBab::where('id_dosen',$id_dosen)->sum('point_menonton_yt');
        $tugas = SubBab::where('id_dosen',$id_dosen)->sum('point_tugas');
        $quiz = SubQuiz::whereHas('quiz', function($query) use ($id_dosen) {
            $query->where('id_dosen',$id_dosen);
        })->count();
        $total_point = $membaca + $menonton_yt + $tugas + $quiz * 10;

        $id_user = Auth::id();

        $membaca_user = LogSubBabUser::where('id_user', $id_user)->sum('point_membaca');
        $menonton_yt_user = LogSubBabUser::where('id_user', $id_user)->sum('point_menonton_yt');
        $tugas_user = LogSubBabUser::where('id_user', $id_user)->sum('point_tugas');
        $quiz_user = QuizPengumpulan::where('id_user', $id_user)->where('is_benar', 1)->count() * 10;
        $total_point_user = $membaca_user + $menonton_yt_user + $tugas_user + $quiz_user;

        $peringkats = PeringkatController::calculateRank(Auth::user()->id_dosen);
        return view('pages.mahasiswa.home', compact('datas', 'total_point', 'total_point_user', 'peringkats'));
    }
}
