<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bab;
use App\Models\SubBab;
use App\Models\LogBabUser;
use App\Models\LogSubBabUser;
use App\Models\User;
use App\Models\Quiz;
use App\Models\SubQuiz;
use App\Models\QuizPengumpulan;
use Illuminate\Support\Facades\Auth;
use File;

function getSubBabWithStatus($id_bab, $userId) {
    $subBabs = SubBab::where('id_bab', $id_bab)->get();

    $logSubBabs = LogSubBabUser::where('id_user', $userId)
        ->whereIn('id_sub_bab', $subBabs->pluck('id'))
        ->get()
        ->groupBy('id_sub_bab');

    $subBabsWithStatus = $subBabs->map(function ($subBab) use ($logSubBabs) {
        $log = $logSubBabs->get($subBab->id);
        
        $subBab->status = $log ? $log->first()->status : 'belumAda';
        $subBab->log_point_membaca = $log ? $log->first()->point_membaca : 0;
        $subBab->log_point_menonton_yt = $log ? $log->first()->point_menonton_yt : 0;
        $subBab->log_point_tugas = $log ? $log->first()->point_tugas : 0;
        $subBab->jumlah_revisi = $log ? $log->where('status_tugas', 'revisi')->count() : 0;

    
        $subBab->log_point_user =  $subBab->log_point_membaca +  $subBab->log_point_menonton_yt + $subBab->log_point_tugas; 

        return $subBab;
    });

    $subBabsWithStatus = $subBabsWithStatus->sortBy('index');

    return $subBabsWithStatus;
}


function getPreTest($id_bab){
    $preTest = Quiz::where('id_bab', $id_bab)->where('type', 'pre-test')->first();
    return $preTest;
}
function jumlahPreTest($id_bab){
    $preTest = Quiz::where('id_bab', $id_bab)->where('type', 'pre-test')->first();
    $sub_quiz = SubQuiz::Where('id_quiz',$preTest->id)->get();
    return $sub_quiz;
}

function logPreTest($id_bab, $id_user){
    $preTest = Quiz::where('id_bab', $id_bab)->where('type', 'pre-test')->first();
    $log = QuizPengumpulan::where('id_quiz', $preTest->id)->where('id_user', $id_user)->get();
    return $log;
}

function getPostTest($id_bab){
    $postTest = Quiz::where('id_bab', $id_bab)->where('type', 'post-test')->first();
    return $postTest;
}
function jumlahPostTest($id_bab){
    $postTest = Quiz::where('id_bab', $id_bab)->where('type', 'post-test')->first();
    $sub_quiz = SubQuiz::Where('id_quiz',$postTest->id)->get();
    return $sub_quiz;
}

function logPostTest($id_bab, $id_user){
    $postTest = Quiz::where('id_bab', $id_bab)->where('type', 'post-test')->first();
    $log = QuizPengumpulan::where('id_quiz', $postTest->id)->where('id_user', $id_user)->get();
    return $log;
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
        $openPostTest = true;
        foreach ($datas as $data) {
            if ($data->status !== 'selesai') {
                $openPostTest = false;
                break;
            }
        }


        $bab = Bab::findOrFail($id_bab);

        $membaca = SubBab::where('id_bab', $id_bab)->sum('point_membaca');
        $menonton_yt = SubBab::where('id_bab', $id_bab)->sum('point_menonton_yt');
        $tugas = SubBab::where('id_bab', $id_bab)->sum('point_tugas');
        $quiz = Quiz::where('id_bab', $id_bab)
                ->with('subQuizs')
                ->get();
        $quiz = $quiz->sum(function($quiz) {
            return $quiz->subQuizs->count() * 10;
        });
        $total_point = $membaca + $menonton_yt + $tugas + $quiz;

        $membaca_user = $datas->sum('log_point_membaca');
        $menonton_yt_user = $datas->sum('log_point_menonton_yt');
        $tugas_user = $datas->sum('log_point_tugas');

        $pre_test = getPreTest($id_bab);
        if($pre_test == null){
        alert()->error('Gagal','Materi belum siap');
        return back();
        }
        $jumlah_pre_test = jumlahPreTest($id_bab)->count() * 10;
        $log_pre_test = logPreTest($id_bab, $userId);
        $jumlah_benar_pre_test = logPreTest($id_bab, $userId)->where('is_benar', 1)->count() * 10;

        $post_test = getPostTest($id_bab);
        if($post_test == null){
            alert()->error('Gagal','Materi belum siap');
            return back();
            }
        $jumlah_post_test = jumlahPostTest($id_bab)->count() * 10;
        $log_post_test = logPostTest($id_bab, $userId);
        $jumlah_benar_post_test = logPostTest($id_bab, $userId)->where('is_benar', 1)->count() * 10;

        $total_point_user = $membaca_user + $menonton_yt_user + $tugas_user + $jumlah_benar_pre_test + $jumlah_benar_post_test;

        $peringkats = PeringkatController::calculateRank();

        return view('pages.mahasiswa.sub_bab.index', 
        compact('datas', 'peringkats', 'bab','logBabUser', 'total_point', 'total_point_user', 
                'pre_test','jumlah_pre_test', 'log_pre_test', 'jumlah_benar_pre_test',
                'post_test','jumlah_post_test', 'log_post_test', 'jumlah_benar_post_test', 'openPostTest'));
    }

    public function baca($id_bab, $id){
        $userId = auth()->id();
        $logSubBabUser = LogSubBabUser::where('id_bab', $id_bab)
                                ->where('id_sub_bab', $id)
                                ->where('id_user', $userId)
                                ->first();

        if (!$logSubBabUser) {
            return view('pages.404'); // Melempar exception jika tidak ditemukan log_bab_user
        }
        $data = SubBab::findOrFail($id);
        $bab = Bab::findOrFail($id_bab);
        return view('pages.mahasiswa.sub_bab.baca', compact('data', 'bab', 'logSubBabUser'));
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
                alert()->error('Gagal','Silahkan coba lagi');
                return back();
            }
        }
    }

    public function selesaiBaca($id_bab, $id){
        try {
            $userId = auth()->id(); // Mengambil ID user yang sedang login
            $log_sub_bab = LogSubBabUser::where('id_bab', $id_bab)
            ->where('id_sub_bab', $id)
            ->where('id_user', $userId)
            ->first();
            $sub_bab = SubBab::findOrFail($id);
            $log_sub_bab->point_membaca = $sub_bab->point_membaca;
            $log_sub_bab->save();

            $user = User::findOrFail($userId);
            $user->uang = $user->uang + $sub_bab->point_membaca;
            $user->save();

            alert()->success('Berhasil','Anda telah membaca materi dan mendapatkan +'. $log_sub_bab->point_membaca .'poin');
            return back();
        } catch (\Throwable $th) {
            alert()->error('Gagal','Silahkan coba lagi');
            return back();
        }

    }

    public function selesaiMenontonYt($id_bab, $id){
        try {
            $userId = auth()->id(); // Mengambil ID user yang sedang login
            $log_sub_bab = LogSubBabUser::where('id_bab', $id_bab)
            ->where('id_sub_bab', $id)
            ->where('id_user', $userId)
            ->first();
            $sub_bab = SubBab::findOrFail($id);
            $log_sub_bab->point_menonton_yt = $sub_bab->point_menonton_yt;
            $log_sub_bab->save();

            $user = User::findOrFail($userId);
            $user->uang = $user->uang + $sub_bab->point_menonton_yt;
            $user->save();
            
            alert()->success('Berhasil','Anda telah membaca materi dan mendapatkan +'. $log_sub_bab->point_menonton_yt .'poin');
            return back();
        } catch (\Throwable $th) {
            alert()->error('Gagal','Silahkan coba lagi');
            return back();
        }

    }

    public function pengumpulanTugas(Request $request, $id_bab, $id){
        if($request->file_tugas == null){
            alert()->error('Gagal','File tidak boleh kosong');
            return back();            
        }
        try {
            $userId = auth()->id(); // Mengambil ID user yang sedang login
            $log_sub_bab = LogSubBabUser::where('id_bab', $id_bab)
            ->where('id_sub_bab', $id)
            ->where('id_user', $userId)
            ->first();

            File::delete($log_sub_bab->file_tugas);
            $fileName = time() . '_tugas.' . $request->file_tugas->extension();
            $request->file_tugas->move(public_path('assets/tugas/'), $fileName);
            $path = 'assets/tugas/' . $fileName;
            $log_sub_bab->file_tugas = $path;
            $log_sub_bab->status_tugas = 'submit';
            $log_sub_bab->save();
            
            alert()->success('Berhasil','Anda telah mengumpulkan tugas');
            return back();
        } catch (\Exception $th) {
            alert()->error('Gagal','Silahkan coba lagi'. $th->getMessage());
            return back();
        }

    }
}
