<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\SubQuiz;
use App\Helpers\TimeHelper;
use Illuminate\Support\Facades\Auth;

class SubQuizDosenController extends Controller
{
    //
    public function index($id_quiz){
        $datas = SubQuiz::where('id_quiz', $id_quiz)->orderBy('index', 'asc')->get();
        $quiz = Quiz::with('bab')->findOrFail($id_quiz);
        if($quiz->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        $title = 'Hapus Data!';
        $text = "Apakah kamu yakin menghapus data ini?";
        confirmDelete($title, $text);
        return view('pages.dosen.sub_quiz.index', compact('datas', 'quiz'));
    }

    public function create($id_quiz){
        $quiz = Quiz::findOrFail($id_quiz);
        if($quiz->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        return view('pages.dosen.sub_quiz.create', compact('quiz'));
    }

    public function show($id_quiz, $id) {
        $data = SubQuiz::findOrFail($id);
        $quiz = Quiz::findOrFail($id_quiz);
        
        $data->min_akses_materi = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_materi);
        $data->min_akses_yt = TimeHelper::convertSecondsToMinutesAndSeconds($data->min_akses_yt);
        return view('pages.dosen.sub_quiz.show', compact('data', 'quiz'));

    }

    public function store(Request $request, $id_quiz){
        try {
            $formData = $request->all();
            $formData['id_quiz'] = $id_quiz;
            SubQuiz::create($formData);
            alert()->success('Hore!','Data berhasil ditambah');
            return redirect()->route('dosen.sub_quiz.index',['id_quiz' => $id_quiz]);
        } catch (\Exception $th) {
            return redirect()->route('dosen.sub_quiz.index',['id_quiz' => $id_quiz])->with('error','Penambahan Sub Quiz gagal karena'. $th->getMessage());
            //throw $th;
        }
    }

    public function edit($id_quiz, $id) {
        $data = SubQuiz::with('quiz')->findOrFail($id);
        $quiz = Quiz::findOrFail($id_quiz);
        if($quiz->id_dosen != Auth::id() || $data->quiz->id_dosen != Auth::id()){
            return redirect()->route('404');
        }
        return view('pages.dosen.sub_quiz.edit', compact('data', 'quiz'));
    }
    
    public function update(Request $request, $id_quiz, $id) {
        try {
            $quiz = SubQuiz::findOrFail($id);
            $formData = $request->all();
            $quiz->update($formData);
            alert()->success('Hore!','Data berhasil diubah');
            return redirect()->route('dosen.sub_quiz.index',['id_quiz' => $id_quiz]);
        } catch (\Exception $th) {
            return redirect()->route('dosen.sub_quiz.index',['id_quiz' => $id_quiz])->with('error', 'Update Sub Quiz gagal karena '. $th->getMessage());
            //throw $th;
        }
    }

    public function delete($id_quiz, $id)
    {
        try{
            $quiz = SubQuiz::findOrFail($id);
            $quiz->delete();
            alert()->success('Hore!','Data berhasil dihapus');
            return back();
        }catch(\Exception $e){
            return redirect()->route('dosen.sub_quiz.index', ['id_quiz' => $id_quiz])->with('gagal', 'Terjadi kesalahan: ' . $e->getMessage() . ' Silahkan coba lagi atau hubungi admin');
        } 
    }
}
