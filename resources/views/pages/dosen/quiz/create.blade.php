@extends('layouts.master')
@section('title', 'Manajemen Kuis')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link')
@section('content')

    <div class="pagetitle">
        <h1>Manajemen Kuis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.quiz.index') }}">Manajemen Kuis</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Bab</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('dosen.quiz.store') }}" method="POST" class="row g-3 needs-validation"
                            novalidate>
                            @csrf
                            <div class="col-md-12">
                                <label for="id_bab" class="form-label">Role <small class="text-danger">*</small></label>
                                <select class="form-select" id="id_bab" name="id_bab"
                                    aria-label="Default select example">
                                    @foreach ($babs as $bab)
                                        <option value="{{ $bab->id }}"
                                            {{ old('id_bab') == $bab->id ? 'selected' : '' }}>
                                            {{ $bab->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="type" class="form-label">Tipe <small class="text-danger">*</small></label>
                                <select class="form-select" id="type" name="type"
                                    aria-label="Default select example">
                                    <option value="pre-test" {{ old('type') == 'pre-test' ? 'selected' : '' }}>Pre Test
                                    </option>
                                    <option value="post-test" {{ old('type') == 'post-test' ? 'selected' : '' }}>Post Test
                                    </option>

                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="petunjuk_pengerjaan" class="form-label">Deskripsi</label>
                                <textarea name="petunjuk_pengerjaan" class="form-control" id="petunjuk_pengerjaan" cols="30" rows="3"
                                    required></textarea>
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
