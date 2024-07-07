@extends('layouts.master')
@section('title', 'Peringkat')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')
@section('peringkat', 'nav-link')

@section('content')


    <section class="section dashboard">
        <div class="row">

            <!-- Admin Card -->
            <div class="col-12">
                <div class="card info-card customers-card">
                    <div class="card-body pt-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-trophy"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 18px">
                                    <span class="" style="color: #4d4d4d">Daftar Peringkat
                                        <span style="color: #4d4d4d">dari</span>
                                        {{ $jumlahUser }} <span style="color: #4d4d4d">mahasiswa</span>
                                </h6>
                                <span class="text-muted small pt-2">
                                    Pantau terus kelajuan mahasiswa dan beri semangat pada mahasiswa untuk saling berlomba
                                    menjadi yang teratas
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-between">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peringkat</h5>

                        <!-- Default Table -->
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Prodi</th>
                                        <th scope="col">Angkatan</th>
                                        <th scope="col">Poin</th>
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
                                            <td>{{ $data->prodi }}</td>
                                            <td>{{ $data->angkatan }}</td>
                                            <td>{{ $data->total_points }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                        <!-- End Default Table Example -->
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
