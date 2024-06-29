@extends('layouts.master')
@section('title', 'Edit Bab Materi')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')

@section('content')

    <div class="pagetitle">
        <h1>Edit Bab Materi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.bab.index') }}">Manajemen Materi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Bab Materi</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('dosen.bab.update', ['id' => $data->id]) }}" method="POST"
                            class="row g-3 needs-validation" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <label for="index" class="form-label">Index</label>
                                <input type="number" name="index" class="form-control" id="index"
                                    value="{{ old('index', $data->index) }}" required>

                            </div>
                            <div class="col-md-12">
                                <label for="beli_point" class="form-label">Beli <small class="text-warning">*point yang
                                        diperlukan untuk mengakses materi</small></label>
                                <input type="number" min="0" name="beli_point" class="form-control" id="beli_point"
                                    value="{{ old('beli_point', $data->beli_point) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="nama" class="form-label">Nama Bab</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    value="{{ old('nama', $data->nama) }}" placeholder="contoh: Topik I. Pengelolaan model"
                                    required>

                            </div>
                            <div class="col-md-12">
                                <label for="durasi" class="form-label">Durasi</label>
                                <input type="text" name="durasi" class="form-control" id="durasi"
                                    value="{{ old('durasi', $data->durasi) }}"
                                    placeholder="contoh: 1 pertemuan pertemuan ke-3" required>
                            </div>
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi" cols="30" rows="3" required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label id="capaian_pembelajaran" class="form-label">Capaian Pembelajaran</label>

                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="capaian_pembelajaran" name="capaian_pembelajaran">{{ old('capaian_pembelajaran', $data->capaian_pembelajaran) }}</textarea><!-- End TinyMCE Editor -->

                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
