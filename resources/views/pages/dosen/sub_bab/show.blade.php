@extends('layouts.master')
@section('title', 'Manajemen Materi')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')

@section('content')
    @include('sweetalert::alert')
    <div class="pagetitle">
        <h1>Manajemen Materi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.bab.index') }}">Manajemen Materi</a> </li>
                <li class="breadcrumb-item active">{{ $bab->nama }}</li>
            </ol>
        </nav>

        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <h3>{{ $data->nama }}</h3>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-history" style="font-size:24px"></i>
                                    <small class="mx-2 mb-0">{{ $data->min_akses_materi }}</small>
                                    <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                    <strong class="ms-2 mb-0">{{ $data->point_membaca }}</strong>
                                </div>
                            </div>
                            {!! $data->content !!}


                        </div>
                    </div>
                    @if ($data->link_yt)
                        <div class="card">
                            <div class="card-body mt-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong>Silahkan simak video di bawah ini</strong>
                                    <div class="d-flex align-items-center">
                                        <i class="bx bx-history" style="font-size:24px"></i>
                                        <small class="mx-2 mb-0">{{ $data->min_akses_yt }}</small>
                                        <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                        <strong class="ms-2 mb-0">{{ $data->point_menonton_yt }}</strong>
                                    </div>
                                </div>
                                <div class="embed-responsive embed-responsive-16by9 my-2">
                                    <iframe class="embed-responsive-item" src="{{ $data->link_yt }}"
                                        allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="mb-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <strong>Tugas</strong>
                                    <div class="d-flex align-items-center">
                                        <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                        <strong class="ms-2 mb-0">{{ $data->point_tugas }}</strong>
                                    </div>
                                </div>
                            </div>
                            {!! $data->uraian_tugas !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')

@endsection
