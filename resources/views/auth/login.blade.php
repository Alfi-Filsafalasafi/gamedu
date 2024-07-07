<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Laravel') }} - Login</title>

    @include('layouts.scripts.css')
</head>



<body>
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="">
                                    <span class="d-none d-lg-block">{{ env('APP_NAME', 'Laravel') }}</span>
                                </a>
                            </div><!-- End Logo -->

                            @error('email')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Ups, email atau password anda salah!

                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @enderror

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                                        <p class="text-center small">Masukkan email dan password anda</p>
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}"
                                        novalidate>
                                        @csrf

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>

                                            <input type="email" name="email" class="form-control" id="yourEmail"
                                                value="{{ old('email') }}" required>
                                            <div class="invalid-feedback">Masukkan email anda</div>

                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Masukkan password anda</div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Belum punya akun? <a
                                                    href="{{ route('register') }}">Buat
                                                    Akun</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="credits">
                                Designed by <a href="https://alfi-filsafalasafi.github.io/My/">Alfi Filsafalasafi</a>
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
