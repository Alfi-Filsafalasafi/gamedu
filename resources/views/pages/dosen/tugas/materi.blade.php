@extends('layouts.master')
@section('title', 'Home Dosen')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link')
@section('content')
    @include('sweetalert::alert')

    <section class="section dashboard">
        <div class="row justify-content-between">
            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-start">
                    <nav>
                        <h1>Tugas Mahaiswa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item active">Materi</li>
                        </ol>
                    </nav>
                </div>
                <p>Berikut adalah materi-materi yang tersaji, silahkan pantau perkembangan mahasiswa anda</p>
            </div>
            <div class="col-lg-12">
                <div class="row justify-content-between">
                    @foreach ($datas as $data)
                        <div class="col-md-6 col-lg-4">
                            <div class="card">
                                <div class="d-flex justify-content-end align-items-center me-3 mt-2">
                                    <i class="ri-money-dollar-box-fill text-success me-2" style="font-size: 20px"></i>
                                    <span class="me-4">{{ $data->beli_point ?? 0 }}</span>
                                    <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                    <span class="" style="font-size: 16px">
                                        {{ $data->subBabs->sum('point_membaca') + $data->subBabs->sum('point_menonton_yt') + $data->subBabs->sum('point_tugas') }}</span>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        {{ $data->nama }}
                                    </h5>
                                    <p class="m-0 limited-text small">{{ $data->durasi }}</p>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        @if ($data->jumlah_tugas > 0)
                                            <span class="badge bg-primary me-3">{{ $data->jumlah_tugas }}</span>
                                        @endif
                                        <a href="{{ route('dosen.tugas.sub_bab', ['id_bab' => $data->id]) }}"
                                            class="btn btn-sm btn-outline-primary">Akses Materi</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
