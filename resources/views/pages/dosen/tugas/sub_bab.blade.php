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
                        <h1>Tugas Mahasiswa</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('dosen.tugas.bab') }}">Materi</a></li>
                            <li class="breadcrumb-item active">{{ $bab->nama }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class="" style="font-size: 20px">
                            {{ $total_point }}</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5>{{ $bab->nama }}</h5>
                    <div class="alert border-primary fade show small pb-0" role="alert">
                        <b>Capaian Pembelajaran</b>
                        {!! $bab->capaian_pembelajaran !!}

                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($datas as $data)
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="d-flex justify-content-end align-items-center me-3 mt-2">
                                <i class="ri-money-dollar-box-fill text-success me-2" style="font-size: 20px"></i>
                                <span class="me-4">{{ $data->beli_point ?? 0 }}</span>
                                <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                <span style="font-size: 16px"><b>
                                        {{ $data->point_membaca + $data->point_menonton_yt + $data->point_tugas }}
                                    </b></span>
                            </div>
                            <div class="card-body">
                                <h5 class="m-0 pt-3 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                    {{ $data->nama }}
                                </h5>
                                <div class="d-flex justify-content-end mt-2 align-items-center">
                                    @if ($data->jumlah_tugas > 0)
                                        <span class="badge bg-primary me-3">{{ $data->jumlah_tugas }}</span>
                                    @endif
                                    <a href="{{ route('dosen.tugas.pengumpulan', ['id_bab' => $data->id_bab, 'id' => $data->id]) }}"
                                        class="btn btn-sm btn-outline-primary">Akses Tugas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>
@endsection
