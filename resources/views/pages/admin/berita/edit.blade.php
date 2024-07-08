@extends('layouts.master')
@section('title', 'Edit Berita')
@section('dashboard', 'nav-link collapsed')
@section('user', 'nav-link collapsed')
@section('info', 'nav-link collapsed')
@section('berita', 'nav-link')
@section('content')
    <div class="pagetitle">
        <h1>Edit Berita</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.berita.index') }}">Manajemen Informasi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Berita</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('admin.berita.update', $data->id) }}" class="row g-3 needs-validation"
                            method="POST" enctype="multipart/form-data" id="uploadForm" novalidate>
                            @csrf
                            @method('PATCH')
                            <div class="col-md-12">
                                <label for="judul" class="form-label">Judul <small class="text-danger">*</small></label>
                                <input type="text" name="judul" class="form-control" id="judul"
                                    value="{{ old('judul', $data->judul) }}" required>
                                @error('judul')
                                    <small class="mt-0 text-danger" style="font-size: 12px">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="deskripsi" class="form-label">Deskripsi <small class="text-danger">*</small>
                                    <small>anda bisa memasukkan 20-50 kata paling pertama pada sajian
                                        content</small></label>
                                <textarea cols="3" rows="3" name="deskripsi" class="form-control" id="deskripsi" required>{{ old('deskripsi', $data->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <small class="mt-0 text-danger" style="font-size: 12px">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="photo" class="col-md-4 col-lg-3 col-form-label">Image
                                    <small>opsional</small></label>
                                <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                @error('photo')
                                    <small class="mt-0 text-danger" style="font-size: 12px">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-12">
                                <label for="content" class="form-label">Konten</label>

                                <!-- TinyMCE Editor -->
                                <textarea class="tinymce-editor" id="content" name="content" required>{{ old('content', $data->content) }}</textarea><!-- End TinyMCE Editor -->

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('photo');
            var file = fileInput.files[0];

            if (file && file.size > 2 * 1024 * 1024) { // 2 MB in bytes
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gambar Tidak boleh lebih dari 2MB'
                });
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
@endsection
