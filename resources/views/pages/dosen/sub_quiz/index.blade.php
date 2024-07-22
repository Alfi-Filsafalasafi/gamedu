@extends('layouts.master')
@section('title', 'Manajemen Kuis')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link')
@section('tugas', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')
@section('style')
    <style>
        .modal-body img {
            width: 100%;
            height: auto;
        }
    </style>
@endsection
@section('content')


    <div class="pagetitle">
        <h1>Manajemen Kuis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.quiz.index') }}">Manajemen Kuis</a></li>
                <li class="breadcrumb-item active">{{ $quiz->bab->nama }}</li>
                <li class="breadcrumb-item active">{{ $quiz->type }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Kuis / {{ $quiz->bab->nama }} / {{ $quiz->type }}</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan akun yang ada</p>
                        <a href="{{ route('dosen.sub_quiz.create', ['id_quiz' => $quiz->id]) }}"
                            class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="15%"><i class="bx bx-cog"></i></th>
                                        <th>Index</th>
                                        <th>Pertanyaan</th>
                                        <th>Jawaban A</th>
                                        <th>Jawaban B</th>
                                        <th>Jawaban C</th>
                                        <th>Jawaban D</th>
                                        <th>Jawaban E</th>
                                        <th>Kunci Jawaban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                <a href="{{ route('dosen.sub_quiz.edit', ['id_quiz' => $quiz->id, 'id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                <a href="{{ route('dosen.sub_quiz.delete', ['id_quiz' => $quiz->id, 'id' => $data->id]) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $data->index }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatPertanyaan{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatPertanyaan{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Pertanyaan</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->pertanyaan !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatJawabanA{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatJawabanA{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Jawaban A</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->jawaban_a !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatJawabanB{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatJawabanB{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Jawaban B</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->jawaban_b !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatJawabanC{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatJawabanC{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Jawaban C</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->jawaban_c !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatJawabanD{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatJawabanD{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Jawaban D</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->jawaban_d !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#lihatJawabanE{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>
                                                <div class="modal fade" id="lihatJawabanE{{ $data->id }}"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Lihat
                                                                    Jawaban E</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->jawaban_e !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $data->kunci_jawaban }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
