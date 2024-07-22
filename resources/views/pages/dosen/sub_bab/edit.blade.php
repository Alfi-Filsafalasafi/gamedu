@extends('layouts.master')
@section('title', 'Edit Sub Bab')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')

@section('content')

    <div class="pagetitle">
        <h1>Edit Sub Bab</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.bab.index') }}">Manajemen Materi</a></li>
                <li class="breadcrumb-item active">{{ $bab->nama }}</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Sub Bab</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('dosen.sub_bab.update', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                            method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
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
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    value="{{ old('nama', $data->nama) }}" placeholder="contoh : mulai diri" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Konten</label>

                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="content" name="content">{{ old('content', $data->content) }}</textarea><!-- End TinyMCE Editor -->

                            </div>
                            <div class="col-lg-12">
                                <label for="uraian_tugas" class="form-label">Uraian Tugas</label>

                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="uraian_tugas" name="uraian_tugas">{{ old('uraian_tugas', $data->uraian_tugas) }}</textarea><!-- End TinyMCE Editor -->

                            </div>
                            <div class="col-lg-12">
                                <label for="rublik_penilaian" class="form-label">Rublik Penilaian</label>

                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="rublik_penilaian" name="rublik_penilaian">{{ old('rublik_penilaian', $data->rublik_penilaian) }}</textarea><!-- End TinyMCE Editor -->

                            </div>
                            <div class="col-md-12">
                                <label for="link_yt" class="form-label">Link Youtube Embed <small
                                        class="text-success">*opsional</small></label>
                                <input type="text" name="link_yt" class="form-control" id="link_yt"
                                    value="{{ old('link_yt', $data->link_yt) }}"
                                    placeholder="contoh: https://www.youtube.com/embed/4T7XMNQU0fs?si=FK1q5cMWzUlHj5gW">
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <label for="point_membaca" class="form-label">Point Membaca</label>
                                <input type="number" min="0" name="point_membaca" class="form-control"
                                    id="point_membaca" value="{{ old('point_membaca', $data->point_membaca) }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="point_menonton_yt" class="form-label">Point Menonton Video Youtube <small
                                        class="text-success">*diisi jika ada link_yt</small></label>
                                <input type="number" min="0" name="point_menonton_yt" class="form-control"
                                    id="point_menonton_yt"
                                    value="{{ old('point_menonton_yt', $data->point_menonton_yt) }}">
                            </div>
                            <div class="col-md-12">
                                <label for="point_tugas" class="form-label">Point Tugas</label>
                                <input type="number" min="0" name="point_tugas" class="form-control"
                                    id="point_tugas" value="{{ old('point_tugas', $data->point_tugas) }}" required>
                            </div>
                            <hr>
                            <div class="row mt-1">
                                <small class="text-secondary mb-2">Anda dapat mempertimbangkan dari jumlah point membaca +
                                    menonton yt + tugas</small>
                                <label for="bintang_1" class="col-sm-4 col-md-2 col-form-label">Bintang 1</label>
                                <div class="col-sm-8 col-md-6">
                                    <input type="number" min="0" name="bintang_1" id="bintang_1"
                                        class="form-control" value="{{ old('bintang_1', $data->bintang_1) }}" required />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="bintang_2" class="col-sm-4 col-md-2 col-form-label">Bintang 2</label>
                                <div class="col-sm-8 col-md-6">
                                    <input type="number" min="0" name="bintang_2" id="bintang_2"
                                        class="form-control" value="{{ old('bintang_2', $data->bintang_2) }}" required />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label for="bintang_3" class="col-sm-4 col-md-2 col-form-label">Bintang 3</label>
                                <div class="col-sm-8 col-md-6">
                                    <input type="number" min="0" name="bintang_3" id="bintang_3"
                                        class="form-control" value="{{ old('bintang_3', $data->bintang_3) }}" required />
                                </div>
                            </div>

                            <hr>
                            <div class="col-md-12">
                                <label for="min_akses_materi" class="form-label">Minimal Akses Materi</label>
                                <div class="input-group mb-3">
                                    <input type="number" min="0" name="min_akses_materi" id="min_akses_materi"
                                        class="form-control"
                                        value="{{ old('min_akses_materi', $data->min_akses_materi) }}" required />
                                    <span class="input-group-text">detik</span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="min_akses_yt" class="form-label">Minimal Akses Youtube <small
                                        class="text-success">*diisi jika ada link yt</small></label>
                                <div class="input-group mb-3">
                                    <input type="number" min="0" name="min_akses_yt" id="min_akses_yt"
                                        class="form-control" value="{{ old('min_akses_yt', $data->min_akses_yt) }}" />
                                    <span class="input-group-text">detik</span>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <label for="lampiran_pdf" class="form-label">Lampiran konten pdf
                                    <small class="text-success">*opsional</small></label>
                                <input type="file" name="lampiran_pdf" id="lampiran_pdf" accept="application/pdf"
                                    class="form-control" />
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
