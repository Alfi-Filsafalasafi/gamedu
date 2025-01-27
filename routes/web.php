<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\WelcomeController;

use App\Http\Controllers\Mahasiswa\HomeMahasiswaController;
use App\Http\Controllers\Mahasiswa\BabMahasiswaController;
use App\Http\Controllers\Mahasiswa\SubBabMahasiswaController;
use App\Http\Controllers\Mahasiswa\QuizMahasiswaController;
use App\Http\Controllers\Mahasiswa\PeringkatController;
use App\Http\Controllers\Mahasiswa\GamesMahasiswaController;

use App\Http\Controllers\Dosen\HomeDosenController;
use App\Http\Controllers\Dosen\BabDosenController;
use App\Http\Controllers\Dosen\QuizDosenController;
use App\Http\Controllers\Dosen\SubBabDosenController;
use App\Http\Controllers\Dosen\SubQuizDosenController;
use App\Http\Controllers\Dosen\TugasDosenController;

use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\BeritaAdminController;
use App\Http\Controllers\Admin\InfoAdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/berita/{id}',[BeritaController::class, 'index'])->name('berita');

Auth::routes();
Route::middleware('auth')->group(function () {
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('profile')->name('profile.')->group(function(){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::patch('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
    Route::patch('/updatePassword', [ProfileController::class, 'updatePassword'])->name('updatePassword');

});
Route::middleware(['role:mahasiswa'])->group(function () {
    Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        Route::get('/', [HomeMahasiswaController::class, 'index'])->name('index');

        Route::prefix('peringkat')->name('peringkat.')->group(function () {
            Route::get('/', [PeringkatController::class, 'index'])->name('index');

        });

        Route::prefix('games')->name('games.')->group(function (){
            Route::get('/', [GamesMahasiswaController::class, 'index'])->name('index');
        });


        Route::prefix('bab')->name('bab.')->group(function () {
            Route::get('/', [BabMahasiswaController::class, 'index'])->name('index');
            Route::post('/{id}', [BabMahasiswaController::class, 'beli'])->name('beli');
        });
        Route::prefix('bab/{id_bab}')->name('sub_bab.')->group(function () {
            Route::get('/', [SubBabMahasiswaController::class, 'index'])->name('index');
            Route::post('/{id}', [SubBabMahasiswaController::class, 'beli'])->name('beli');
            Route::get('/baca/{id}', [SubBabMahasiswaController::class, 'baca'])->name('baca');
            Route::patch('/selesai-baca/{id}', [SubBabMahasiswaController::class, 'selesaiBaca'])->name('selesaiBaca');
            Route::patch('/selesai-menonton-yt/{id}', [SubBabMahasiswaController::class, 'selesaiMenontonYt'])->name('selesaiMenontonYt');
            Route::patch('/pengumpulan-tugas/{id}', [SubBabMahasiswaController::class, 'pengumpulanTugas'])->name('pengumpulanTugas');            
        });
        Route::prefix('quiz/{id_bab}')->name('quiz.')->group(function(){
            Route::get('/{id}', [QuizMahasiswaController::class, 'index'])->name('index');
            Route::get('/{id}/berhasil', [QuizMahasiswaController::class, 'berhasil'])->name('berhasil');
            Route::post('/{id}', [QuizMahasiswaController::class, 'submitJawaban'])->name('submitJawaban');

        });
    });

});
Route::middleware(['role:dosen'])->group(function () {
    Route::prefix('dosen')->name('dosen.')->group(function () {
        Route::get('/', [HomeDosenController::class, 'index'])->name('index');
        //bab
        Route::prefix('bab')->name('bab.')->group(function () {
            Route::get('/', [BabDosenController::class, 'index'])->name('index');
            Route::get('/create', [BabDosenController::class, 'create'])->name('create');
            Route::get('/show', [BabDosenController::class, 'show'])->name('show');
            Route::post('/store', [BabDosenController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BabDosenController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [BabDosenController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BabDosenController::class, 'delete'])->name('delete');
        });
        //sub bab
        Route::prefix('bab/{id_bab}')->name('sub_bab.')->group(function () {
            Route::get('/', [SubBabDosenController::class, 'index'])->name('index');
            Route::get('/create', [SubBabDosenController::class, 'create'])->name('create');
            Route::get('/show/{id}', [SubBabDosenController::class, 'show'])->name('show');
            Route::post('/store', [SubBabDosenController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SubBabDosenController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [SubBabDosenController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [SubBabDosenController::class, 'delete'])->name('delete');
        });
        //quiz
        Route::prefix('quiz')->name('quiz.')->group(function () {
            Route::get('/', [QuizDosenController::class, 'index'])->name('index');
            Route::get('/create', [QuizDosenController::class, 'create'])->name('create');
            Route::get('/show', [QuizDosenController::class, 'show'])->name('show');
            Route::post('/store', [QuizDosenController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [QuizDosenController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [QuizDosenController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [QuizDosenController::class, 'delete'])->name('delete');
        });
        //sub quiz
        Route::prefix('quiz/{id_quiz}')->name('sub_quiz.')->group(function () {
            Route::get('/', [SubQuizDosenController::class, 'index'])->name('index');
            Route::get('/create', [SubQuizDosenController::class, 'create'])->name('create');
            Route::get('/show/{id}', [SubQuizDosenController::class, 'show'])->name('show');
            Route::post('/store', [SubQuizDosenController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SubQuizDosenController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [SubQuizDosenController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [SubQuizDosenController::class, 'delete'])->name('delete');
        });

        Route::prefix('tugas')->name('tugas.')->group(function () {
            Route::get('/materi', [TugasDosenController::class, 'bab'])->name('bab');
            Route::get('/materi/{id_bab}', [TugasDosenController::class, 'sub_bab'])->name('sub_bab');
            Route::get('/materi/{id_bab}/pengumpulan/{id}', [TugasDosenController::class, 'pengumpulan'])->name('pengumpulan');
            Route::get('/materi/{id_bab}/pengumpulan/{id_sub_bab}/respon/{id}', [TugasDosenController::class, 'respon'])->name('respon');
            Route::post('/materi/submit/respon/{id}', [TugasDosenController::class, 'submitRespon'])->name('submitRespon');
        });

        Route::prefix('peringkat')->name('peringkat.')->group(function () {
            Route::get('/', [PeringkatController::class, 'indexDosen'])->name('index');

        });

    });

});

Route::middleware(['role:admin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [HomeAdminController::class, 'index'])->name('index');

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/', [UserAdminController::class, 'index'])->name('index');
            Route::get('/create', [UserAdminController::class, 'create'])->name('create');
            Route::post('/store', [UserAdminController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserAdminController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserAdminController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserAdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('berita')->name('berita.')->group(function () {
            Route::get('/', [BeritaAdminController::class, 'index'])->name('index');
            Route::get('/create', [BeritaAdminController::class, 'create'])->name('create');
            Route::post('/store', [BeritaAdminController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BeritaAdminController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [BeritaAdminController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BeritaAdminController::class, 'delete'])->name('delete');
        });
        Route::prefix('info')->name('info.')->group(function () {
            Route::get('/', [InfoAdminController::class, 'index'])->name('index');
            Route::get('/create', [InfoAdminController::class, 'create'])->name('create');
            Route::post('/store', [InfoAdminController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [InfoAdminController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [InfoAdminController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [InfoAdminController::class, 'delete'])->name('delete');
        });
    });

});
});


Route::get('/404', function () {
    return view('pages.404');
})->name('404');
Route::fallback(function () {
    return view('pages.404');
});
