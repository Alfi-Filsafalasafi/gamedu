@extends('layouts.master')
@section('title', 'Manajemen Akun')
@section('dashboard', 'nav-link collapsed')
@section('user', 'nav-link')
@section('berita', 'nav-link collapsed')
@section('info', 'nav-link collapsed')
@section('content')
    <div class="pagetitle">
        <h1>Manajemen Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Manajemen Akun</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Akun</h5>

                        <!-- Custom Styled Validation -->
                        <form action="{{ route('admin.user.store') }}" class="row g-3 needs-validation" method="POST"
                            novalidate>
                            @csrf
                            <div class="col-md-12">
                                <label for="name" class="form-label">Nama <small class="text-danger">*</small></label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <small class="mt-0 text-danger" style="font-size: 12px">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email<small class="text-danger">*</small></label>
                                <input type="text" name="email" class="form-control" id="email"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <small class="mt-0 text-danger" style="font-size: 12px">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password<small
                                        class="text-danger">*</small></label>
                                <input type="password" name="password" class="form-control" id="password"
                                    value="{{ old('password') ?? 'password' }}" required>
                            </div>
                            <div class="col-md-12">
                                <label for="prodi" class="form-label">Prodi</label>
                                <input type="text" name="prodi" class="form-control" id="prodi"
                                    value="{{ old('prodi') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="angkatan" class="form-label">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" id="angkatan"
                                    value="{{ old('angkatan') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="role" class="form-label">Role <small class="text-danger">*</small></label>
                                <select class="form-select" id="role" name="role"
                                    aria-label="Default select example" onchange="toggleDosenField()">
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12" id="dosenField" style="display: none;">
                                <label for="role" class="form-label">Dosen Anda <small
                                        class="text-danger">*</small></label>
                                <select class="form-select" id="id_dosen" name="id_dosen"
                                    aria-label="Default select example">
                                    @foreach ($dosens as $dosen)
                                        <option value="{{ $dosen->id }}"
                                            {{ old('id_dosen') == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}
                                        </option>
                                    @endforeach
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
    <script>
        function toggleDosenField() {
            var roleSelect = document.getElementById('role');
            var dosenField = document.getElementById('dosenField');
            if (roleSelect.value == 'mahasiswa') {
                dosenField.style.display = 'block';
            } else {
                dosenField.style.display = 'none';
            }
        }

        // Call the function on page load to set the correct initial state
        document.addEventListener('DOMContentLoaded', function() {
            toggleDosenField();
        });
    </script>
@endsection
