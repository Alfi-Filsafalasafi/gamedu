<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Quiz;
use App\Models\QuizPengumpulan;
use App\Models\SubQuiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuizMahasiswaController extends Controller
{
    //
    public function index($id_bab, $id){
        $id_user = Auth::id();

        $quiz = Quiz::findOrFail($id);
        $datas = SubQuiz::where('id_quiz', $id)->get();
        $jumlah_point = $datas->count() * 10;

        $quiz_pengumpulan = QuizPengumpulan::where('id_user', $id_user)->where('id_quiz', $id)->first();

        if($quiz_pengumpulan){
            return redirect()->route('mahasiswa.quiz.berhasil', ['id_bab' => $id_bab, 'id' => $id]);
        }
        
        return view('pages.mahasiswa.quiz.index', compact('quiz', 'datas', 'jumlah_point'));
    }

    public function submitJawaban($id_bab, $id, Request $request)
    {
        $user_id = Auth::id();

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'jawaban.*.jawaban' => 'required',
        ], [
            'required' => 'Jawaban pada pertanyaan :attribute harus diisi.',
        ]);

        if ($validator->fails()) {
            alert()->error('Gagal','Terdapat soal yang belum anda jawab');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            foreach ($request->jawaban as $quizIndex => $answer) {
                // Save each answer to the database
                // dd($answer);
                $correctAnswer = SubQuiz::where('id', $answer['id_pertanyaan'])->value('kunci_jawaban');

                // Check if the submitted answer is correct
                $isCorrect = ($answer['jawaban'] == $correctAnswer) ? 1 : 0;
                    QuizPengumpulan::create([
                        'id_user'       => $user_id,
                        'id_quiz' => $id,
                        'id_pertanyaan' => $answer['id_pertanyaan'],
                        'jawaban'       => $answer['jawaban'],
                        'is_benar'    => $isCorrect,
                    ]);
            }

            alert()->success('Berhasil','Jawaban anda telah berhasil disimpan');
            return redirect()->route('mahasiswa.quiz.berhasil', ['id_bab' => $id_bab, 'id' => $id]);
        } catch (\Exception $th) {
            //throw $th;
            alert()->error('Gagal','Silahkan coba lagi'. $th->getMessage());
            return back();
        }
    }

    public function berhasil($id_bab, $id){
        $id_user = Auth::id();
        $quiz_pengumpulan = QuizPengumpulan::where('id_user', $id_user)->where('id_quiz', $id)->first();
        if(!$quiz_pengumpulan){
            return redirect()->route('mahasiswa.quiz.index', ['id_bab' => $id_bab, 'id' => $id]);

        }
        $quiz = Quiz::findOrFail($id);
        $datas = QuizPengumpulan::with('subQuiz')
            ->where('id_user', Auth::id())
            ->whereHas('subQuiz', function($query) use ($id) {
                $query->where('id_quiz', $id);
            })
            ->get();
        $jumlah_point = $datas->count() * 10;
        $point_user = QuizPengumpulan::where('id_user', Auth::id()) ->where('id_quiz', $id)->where('is_benar', 1)->count();
        $total_point_user = $point_user * 10;
        return view('pages.mahasiswa.quiz.berhasil', compact('quiz', 'datas', 'jumlah_point', 'total_point_user'));
    }
}
