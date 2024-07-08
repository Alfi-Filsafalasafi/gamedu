@extends('layouts.master')
@section('title', 'Home Dosen')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link')
@section('peringkat', 'nav-link collapsed')

@section('style')
    <style>
        .content img {
            width: 100%;
            height: auto;
        }

        .tugas img {
            width: 100%;
            height: auto;
        }

        /* Untuk layar medium (768px - 992px) */
        @media (min-width: 768px) and (max-width: 992px) {
            .content img {
                width: 80%;
                height: auto;
            }

            .tugas img {
                width: 70%;
                height: auto;
            }
        }

        /* Untuk layar besar (> 992px) */
        @media (min-width: 992px) {
            .content img {
                width: 75%;
                height: auto;

            }

            .tugas img {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection
@section('content')


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
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="mt-2">
                                <small class="text-secondary">{{ $bab->nama }}</small>
                                <h5 class="card-title p-0 mb-1">{{ $sub_bab->nama }}</h5>
                                <p class="">Berikut adalah daftar tugas yang dikumpulkan oleh mahasiswa pada sub
                                    materi ini
                                </p>
                            </div>
                            <div class="d-flex align-items-center mt-3">
                                <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 16px"></i>
                                <span class="" style="font-size: 14px"> Poin maksimal tugas = <b>
                                        {{ $sub_bab->point_tugas }}</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title my-0 pt-3" style="font-size: 14px">Pengumpulan Tugas Mahasiswa</h6>
                                <div class="d-flex mb-2">Nama <div class="ms-2">:</div> <b
                                        class="ms-3">{{ $data->user->name }}</b>
                                </div>
                                <div class="d-flex mb-1">Status <div class="ms-2 me-3">:</div>

                                    @if ($data->status_tugas == 'selesai')
                                        <span class="badge bg-successs">selesai</span>
                                    @elseif($data->status_tugas == 'submit')
                                        <span class="badge bg-primary">submit</span>
                                    @elseif($data->status_tugas == 'revisi')
                                        <span class="badge bg-warning">revisi</span>
                                    @else
                                        <span class="badge bg-secondary">tidak ada</span>
                                    @endif
                                </div>
                                <div class="d-flex">Poin &nbsp;&nbsp; <div class="ms-2 me-3">:</div>
                                    {{ $data->point_tugas ?? 0 }}
                                </div>

                                <h6 class="card-title my-0 pt-3" style="font-size: 14px">File Tugas</h6>
                                <a href="{{ asset($data->file_tugas) }}"
                                    class="btn btn-sm btn-primary">{{ basename($data->file_tugas) }}</a>
                                <div class="alert alert-secondary mt-4" role="alert">
                                    <b>Catatan dosen :</b> <br>
                                    @if ($data->catatan_tugas != '' || $data->catatan_tugas != null)
                                        {!! $data->catatan_tugas !!}
                                    @else
                                        -
                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title my-0 pt-3" style="font-size: 14px">Rublik Penilaian</h6>
                                <div class="tugas">
                                    {!! $sub_bab->rublik_penilaian !!}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title my-0 pt-3" style="font-size: 14px">Respon Anda</h6>
                        <form id="respon-form" method="POST"
                            action="{{ route('dosen.tugas.submitRespon', ['id' => $data->id]) }}" class="needs-validation"
                            novalidate>
                            @csrf
                            <select class="form-select" name="status_tugas" required>
                                <option value="revisi"
                                    {{ old('status_tugas') ?? $data->status_tugas == 'revisi' ? 'selected' : '' }}>
                                    Revisi</option>
                                <option value="selesai"
                                    {{ old('status_tugas') ?? $data->status_tugas == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                            </select>
                            <label for="point_tugas" class="form-label mt-4">Catatan Anda</label>
                            <input type="hidden" name="catatan_tugas" id="quill-content">
                            <div class="quill-editor-default" id="editor" style="height: 120px">
                                {!! $data->catatan_tugas !!}</div>
                            <label for="point_tugas" class="form-label mt-4">Point</label>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control me-3 w-25" name="point_tugas"
                                    value="{{ $data->point_tugas ?? 0 }}" min="0"
                                    max="{{ $sub_bab->point_tugas }}" />
                                <span>/ {{ $sub_bab->point_tugas }} </span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor', {});

            var form = document.querySelector('#respon-form');
            form.onsubmit = function() {
                var content = document.querySelector('input[name=catatan_tugas]');
                content.value = quill.root.innerHTML;
            };
        });
    </script>
@endsection
