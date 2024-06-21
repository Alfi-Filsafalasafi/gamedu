<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class HomeAdminController extends Controller
{
    //
    public function index()
    {
        $visitors = DB::table('visitors')
                        ->select(DB::raw('COUNT(id_user) as jumlah_pengunjung'), DB::raw('DATE(created_at) as tanggal'))
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->orderBy('tanggal', 'asc') // Mengurutkan berdasarkan tanggal terbaru
                        ->limit(10) // Membatasi hasil query menjadi 10 data
                        ->get();

        // Ubah struktur $visitors agar sesuai dengan yang dibutuhkan oleh chart
        $dates = [];
        $prices = [];

        foreach ($visitors as $visitor) {
            $dates[] = $visitor->tanggal;
            $prices[] = $visitor->jumlah_pengunjung;
        }

        $today = Carbon::today();
        $admin = User::where('role', 'admin')->count();
        $adminHariIni = User::where('role', 'admin')->whereDate('created_at', $today)->count();
        $dosen = User::where('role', 'dosen')->count();
        $dosenHariIni = User::where('role', 'dosen')->whereDate('created_at', $today)->count();

        // Menghitung jumlah mahasiswa secara total dan yang dibuat hari ini
        $mahasiswa = User::where('role', 'mahasiswa')->count();
        $mahasiswaHariIni = User::where('role', 'mahasiswa')->whereDate('created_at', $today)->count();

        // dd($adminHariini);

        return view('pages.admin.home', compact('dates', 'prices', 'admin', 'adminHariIni', 'dosen', 'dosenHariIni', 'mahasiswa', 'mahasiswaHariIni'));
    }

}
