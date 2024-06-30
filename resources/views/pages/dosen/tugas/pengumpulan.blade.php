@extends('layouts.master')
@section('title', 'Home Dosen')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link')
@section('peringkat', 'nav-link collapsed')

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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dosen.tugas.sub_bab', ['id_bab' => $sub_bab->id_bab]) }}">{{ $bab->nama }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $sub_bab->nama }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class="" style="font-size: 20px">
                            {{ $total_point }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">{{ $sub_bab->nama }}</h5>
                        <p class="">Berikut adalah daftar tugas yang dikumpulkan oleh mahasiswa pada sub materi ini
                        </p>
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Img</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Point</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($data->photo)
                                                    <img src="{{ asset($data->photo) }}" alt="" style="width: 24px">
                                                @else
                                                    <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}"
                                                        alt="" style="width: 24px">
                                                @endif
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>
                                                @if ($data->status_tugas == 'selesai')
                                                    <a href="{{ route('dosen.tugas.respon', ['id_bab' => $sub_bab->id_bab, 'id_sub_bab' => $sub_bab->id, 'id' => $data->id]) }}"
                                                        class="btn btn-sm btn-success">selesai</a>
                                                @elseif ($data->status_tugas == 'submit')
                                                    <a href="{{ route('dosen.tugas.respon', ['id_bab' => $sub_bab->id_bab, 'id_sub_bab' => $sub_bab->id, 'id' => $data->id]) }}"
                                                        class="btn btn-sm btn-primary">submit</a>
                                                @elseif ($data->status_tugas == 'revisi')
                                                    <a href="{{ route('dosen.tugas.respon', ['id_bab' => $sub_bab->id_bab, 'id_sub_bab' => $sub_bab->id, 'id' => $data->id]) }}"
                                                        class="btn btn-sm btn-warning">revisi</a>
                                                @else
                                                    <span class="badge bg-secondary">belum ada</span>
                                                @endif
                                            </td>
                                            <td>{{ $data->point_tugas ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
