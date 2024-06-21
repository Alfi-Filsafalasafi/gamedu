<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GamEdu - Register</title>

    @include('layouts.scripts.css')
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ route('welcome') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">GamEdu</span>
                                </a>
                            </div><!-- End Logo -->
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Ups, ada kesalahan pada inputan anda!
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="card mb-2">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                        <p class="text-center small">Masukkan data anda untuk membuat akun</p>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}"
                                        class="row g-3 needs-validation" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="text" name="name" class="form-control"
                                                    id="floatingInput" placeholder="" value="{{ old('name') }}"
                                                    required>
                                                <label for="floatingInput">Nama Lengkap</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" name="email" class="form-control"
                                                    id="floatingInput" placeholder="" value="{{ old('email') }}"
                                                    required>
                                                <label for="floatingInput">Email address</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 mb-1">
                                            <legend class="col-form-label">
                                                Jenis Kelamin
                                            </legend>
                                            <div class="d-flex">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        id="lakiRadios" value="L"
                                                        {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }} required />
                                                    <label class="form-check-label" for="lakiRadios">
                                                        Laki-Laki
                                                    </label>
                                                </div>
                                                <div class="form-check ms-4">
                                                    <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                        id="perempuanRadios" value="P"
                                                        {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }} required />
                                                    <label class="form-check-label" for="perempuanRadios">
                                                        Perempuan
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="text" name="prodi" class="form-control"
                                                    id="prodiInput" placeholder="" value="{{ old('prodi') }}" required>
                                                <label for="prodiInput">Prodi</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="number" name="angkatan" class="form-control"
                                                    id="angkatanInput" placeholder="" value="2024" min="2017"
                                                    max="2027" required>
                                                <label for="angkatanInput">Angkatan</label>
                                                <div class="invalid-feedback">Harus diantara 2010 sampai 2027</div>

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="Password" required />
                                                <label for="password">Password</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-floating mb-2">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" placeholder="" required />
                                                <label for="ketikUlangPassword">Ketik Ulang Password</label>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">Saya menyetujui
                                                    <a href="#">kebijakan dan privasi</a></label>
                                                <div class="invalid-feedback">Kamu harus setuju sebelum mendaftar</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="{{ route('login') }}">Log
                                                    in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>

    @include('layouts.scripts.js')
</body>

</html>
