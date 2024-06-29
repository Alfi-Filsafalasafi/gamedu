@extends('layouts.master')
@section('title', 'Manajemen Materi')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link')
@section('tugas', 'nav-link collapsed')

@section('content')

    <div class="pagetitle">
        <h1>Manajemen Materi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.bab.index') }}">Manajemen MKuis</a></li>
                <li class="breadcrumb-item">{{ $quiz->bab->nama }}</li>
                <li class="breadcrumb-item">{{ $quiz->type }}</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Pertanyaan</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('dosen.sub_quiz.update', ['id_quiz' => $quiz->id, 'id' => $data->id]) }}"
                            method="POST" class="row g-3 needs-validation" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <label for="index" class="form-label">Index <small>(soal nomor ke)</small></label>
                                <input type="number" name="index" class="form-control" id="index"
                                    value="{{ old('index', $data->index) }}" required>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Pertanyaan</label>
                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="pertanyaan" name="pertanyaan">{{ old('pertanyaan', $data->pertanyaan) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Jawaban A</label>
                                <textarea class="tinymce-editor" id="jawaban_a" name="jawaban_a">{{ old('jawaban_a', $data->jawaban_a) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Jawaban B</label>
                                <textarea class="tinymce-editor" id="jawaban_b" name="jawaban_b">{{ old('jawaban_b', $data->jawaban_b) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Jawaban C</label>
                                <textarea class="tinymce-editor" id="jawaban_c" name="jawaban_c">{{ old('jawaban_c', $data->jawaban_c) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Jawaban D</label>
                                <textarea class="tinymce-editor" id="jawaban_d" name="jawaban_d">{{ old('jawaban_d', $data->jawaban_d) }}</textarea>
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Jawaban E</label>
                                <textarea class="tinymce-editor" id="jawaban_e" name="jawaban_e">{{ old('jawaban_e', $data->jawaban_e) }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="role" class="form-label">Kunci Jawaban</label>
                                <select class="form-select" id="kunci_jawaban" name="kunci_jawaban"
                                    aria-label="Default select example">
                                    <option value="a"
                                        {{ old('kunci_jawaban', $data->kunci_jawaban) == 'a' ? 'selected' : '' }}>
                                        A</option>
                                    <option value="b"
                                        {{ old('kunci_jawaban', $data->kunci_jawaban) == 'b' ? 'selected' : '' }}>
                                        B</option>
                                    <option value="c"
                                        {{ old('kunci_jawaban', $data->kunci_jawaban) == 'c' ? 'selected' : '' }}>
                                        C</option>
                                    <option value="d"
                                        {{ old('kunci_jawaban', $data->kunci_jawaban) == 'd' ? 'selected' : '' }}>
                                        D</option>
                                    <option value="e"
                                        {{ old('kunci_jawaban', $data->kunci_jawaban) == 'e' ? 'selected' : '' }}>
                                        E</option>
                                </select>
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

@section('scripts')
@endsection
