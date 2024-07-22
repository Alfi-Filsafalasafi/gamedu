@extends('layouts.master')
@section('title', 'profil akun')

@section('dashboard', 'nav-link')
@section('user', 'nav-link collapsed')

@section('materi', 'nav-link collapsed')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')

@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')

@section('berita', 'nav-link collapsed')
@section('info', 'nav-link collapsed')

@section('content')
    <div class="pagetitle">
        <h1>Profil Saya</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    @if (auth()->user()->role == 'admin')
                        <a href="{{ route('admin.index') }}">Home</a>
                    @elseif (auth()->user()->role == 'mahasiswa')
                        <a href="{{ route('mahasiswa.index') }}">Home</a>
                    @elseif(auth()->user()->role == 'dosen')
                        <a href="{{ route('dosen.index') }}">Home</a>
                    @endif

                </li>
                <li class="breadcrumb-item active">Profil Saya</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('assets/img/profile/not-profile-photo.png') }}"
                            alt="Profile" class="rounded-circle">
                        <h2>{{ auth()->user()->name }}</h2>
                        <h3>{{ auth()->user()->role }}</h3>

                    </div>
                </div>

            </div>

            <div class="col-xl-8">
                @include('layouts.partials.alert')
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Ups, ada kesalahan pada inputan anda!
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Ikhtisar</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Detail Anda</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nama</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ auth()->user()->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                                </div>

                                @if (auth()->user()->role == 'mahasiswa')
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Prodi</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->prodi }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Angkatan</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->angkatan }}</div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{ route('profile.updateProfile') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 needs-validation mt-1" id="uploadForm"
                                    novalidate>
                                    @method('PATCH')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                            Image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input type="file" class="form-control" id="profileImage" name="photo"
                                                accept="image/*">
                                            <div class="invalid-feedback">Please upload an image file (max 2MB).</div>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name"
                                                value="{{ old('name') ?? auth()->user()->name }}" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <legend class="col-form-label">
                                            Jenis Kelamin
                                        </legend>
                                        <div class="d-flex">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="lakiRadios" value="L"
                                                    {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'L' ? 'checked' : '' }}
                                                    required />
                                                <span class="" for="lakiRadios">
                                                    Laki-Laki
                                                </span>
                                            </div>
                                            <div class="form-check ms-4">
                                                <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                    id="perempuanRadios" value="P"
                                                    {{ old('jenis_kelamin', auth()->user()->jenis_kelamin) == 'P' ? 'checked' : '' }}
                                                    required />
                                                <span class="form-check-label" for="perempuanRadios">
                                                    Perempuan
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    @if (auth()->user()->role == 'mahasiswa')
                                        <div class="row mb-3">
                                            <label for="prodi" class="col-md-4 col-lg-3 col-form-label">Prodi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="prodi" type="text" class="form-control" id="prodi"
                                                    value="{{ old('prodi') ?? auth()->user()->prodi }}" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="angkatan"
                                                class="col-md-4 col-lg-3 col-form-label">Angkatan</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="angkatan" type="number" class="form-control"
                                                    id="angkatan" min="2017" max="2027"
                                                    value="{{ old('angkatan') ?? auth()->user()->angkatan }}" required>
                                            </div>
                                        </div>
                                    @endif



                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="{{ route('profile.updatePassword') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-3 needs-validation mt-1" novalidate>
                                    @method('PATCH')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="password" type="password" class="form-control"
                                                id="currentPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="newpassword" type="password" class="form-control"
                                                id="newPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="renewpassword" type="password" class="form-control"
                                                id="renewPassword" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.getElementById('uploadForm').addEventListener('submit', function(event) {
            var fileInput = document.getElementById('profileImage');
            var file = fileInput.files[0];
            var isValid = true;

            if (file) {
                // Check file size (2MB = 2 * 1024 * 1024 bytes)
                if (file.size > 2 * 1024 * 1024) {
                    fileInput.classList.add('is-invalid');
                    isValid = false;
                } else {
                    fileInput.classList.remove('is-invalid');
                }
            } else {
                isValid = true;
            }

            if (!isValid) {
                event.preventDefault(); // Stop form submission
                return;
            }
        });
    </script>
@endsection
