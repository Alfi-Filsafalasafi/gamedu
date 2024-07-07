<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Mahasiswa\PeringkatController;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Bab;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeDosenController extends Controller
{
    //
    public function index()
    {
        $bab = Bab::where('id_dosen', Auth::id())->count();
        $mahasiswa = User::where('role', 'mahasiswa')->where('id_dosen', Auth::id())->count();
        $peringkats = PeringkatController::calculateRank(Auth::id());
        $peringkats = $peringkats->take(5);

        return view('pages.dosen.home', compact('mahasiswa', 'bab', 'peringkats'));
    }
}
