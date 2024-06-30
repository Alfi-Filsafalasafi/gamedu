@extends('layouts.master')
@section('title', 'Home Dosen')
@section('dashboard', 'nav-link')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')

@section('content')
    @include('sweetalert::alert')

    <section class="section dashboard">
        <div class="row">

            <div class="col-12">
                <div class="card info-card customers-card">
                    <div class="card-body pt-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-stars"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 18px">Selamat Datang Dosen</h6>
                                <span class="text-muted small pt-2">Sebagai pendidik, kita berperan penting dalam membimbing
                                    mahasiswa menuju kesuksesan. Mari sajikan materi yang inspiratif, kuis yang
                                    menantang, dan tugas yang mendalam. Bersama-sama, menciptakan lingkungan belajar
                                    yang mendukung dan memotivasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-8">
                <div class="row">

                    <!-- Bab Card -->
                    <div class="col-md-6">
                        <div class="card info-card sales-card">
                            <div class="filter">
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Materi <span>| Jumlah saat ini</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $bab }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Bab Card -->

                    <!-- Mahasiswa Card -->
                    <div class="col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="filter">
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Mahasiswa <span>| Jumlah saat ini</span>
                                </h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ $mahasiswa }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Mahasiswa Card -->
                </div>
            </div>
            <div class="col-sm-4">
                @include('layouts.partials.peringkat')
            </div>
        </div>
    </section>
@endsection
