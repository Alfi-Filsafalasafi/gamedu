@extends('layouts.master')
@section('title', 'Edit Kuis')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link')
@section('tugas', 'nav-link collapsed')

@section('content')

    <div class="pagetitle">
        <h1>Edit Kuis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dosen.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dosen.quiz.index') }}">Manajemen Kuis</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Kuis</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('dosen.quiz.update', $data->id) }}" method="POST"
                            class="row g-3 needs-validation" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <label for="id_bab" class="form-label">Bab <small class="text-danger">*</small></label>
                                <select class="form-select" id="id_bab" name="id_bab"
                                    aria-label="Default select example">
                                    @foreach ($babs as $bab)
                                        <option value="{{ $bab->id }}"
                                            {{ $data->id_bab == $bab->id ? 'selected' : '' }}>
                                            {{ $bab->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="type" class="form-label">Tipe <small class="text-danger">*</small></label>
                                <select class="form-select" id="type" name="type"
                                    aria-label="Default select example">
                                    <option value="pre-test" {{ $data->type == 'pre-test' ? 'selected' : '' }}>Pre Test
                                    </option>
                                    <option value="post-test" {{ $data->type == 'post-test' ? 'selected' : '' }}>Post Test
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="petunjuk_pengerjaan" class="form-label">Deskripsi</label>
                                <textarea name="petunjuk_pengerjaan" class="form-control" id="petunjuk_pengerjaan" cols="30" rows="3"
                                    required>{{ $data->petunjuk_pengerjaan }}</textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </form><!-- End Custom Styled Validation -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
