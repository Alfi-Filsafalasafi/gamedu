<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    @include('layouts.scripts.css')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>



<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="d-flex navbar-brand align-items-center order-sm-1" href="#">
                <img src="{{ asset('NiceAdmin/assets/img/favicon.png') }}" alt="Logo"
                    class="d-inline-block align-text-top">
                <div class="nav-title ms-3">{{ env('APP_NAME', 'Laravel') }}</div>
            </a>
            @auth
                <a href="{{ route('login') }}" class="btn btn-primary px-4 ms-4 order-sm-2 order-lg-4">Home</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-primary px-4 ms-4 order-sm-2 order-lg-4">Login</a>
                @endif
                <button class="navbar-toggler border-none rounded-0 order-sm-3 order-lg-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="bi bi-list toggle-sidebar-btn"></span>
                </button>

                <div class="w-100 collapse navbar-collapse justify-content-end order-sm-4 order-lg-3" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link mx-3" aria-current="page" href="#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="#materi">Materi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="#berita">Berita</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-3" href="#info">Info</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section id="home" style="padding-top: 100px">
            <div class="container">
                <div class="d-md-flex">
                    <img class="img-home" src="{{ asset('assets/img/menteri-pendidikan.png') }}" alt=""
                        srcset="">
                    <div class="w-100 d-flex justify-content-end">
                        <img class="img-home" src="{{ asset('assets/img/ppg.png') }}" alt="" srcset="">
                        <img class="img-home" src="{{ asset('assets/img/kurmer.png') }}" alt="">
                    </div>
                </div>
                <div class="row align-items-center mt-4">
                    <div class="col-md-6">
                        <span class="bg-dark text-white p-1">Mata Kuliah Inti</span>
                        <h2 class="title mt-3 mb-3">Prinsip Pengajaran Dan Asesmen II di Sekolah Menengah Kejuruan</h2>
                        <p>Guru adalah pendidik
                            profesional dengan tugas utama mendidik, mengajar, membimbing,
                            mengarahkan, melatih, menilai, dan mengevaluasi peserta didik pada
                            pendidikan anak usia dini jalur pendidikan formal, pendidikan dasar, dan
                            pendidikan menengah. </p>
                    </div>
                    <div class="col-md-6 md-none">
                        <img src="{{ asset('assets/img/home-img.png') }}" class="img-vector float-end" alt=""
                            srcset="">
                    </div>
                </div>
            </div>
        </section>
        <section id="materi" class="mt-4 materi">
            <div class="container pt-4">
                <div class="text-center" style="margin-bottom: 50px">
                    <h3 class="title">Materi</h3>
                    <p class="">Media ini menghadirkan kursus/materi dengan fitur yang menarik.</p>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="title">Apa yang dilakukan dan disajikan?</h5>
                        <p class="deskripsi">Menyajikan kursus dan materi berkualitas dari dosen terkemuka, lengkap dengan
                            tugas yang
                            menantang dan konten menarik. Temukan cara baru untuk belajar dengan pemilihan kata yang cermat
                            dan penyajian luar biasa, yang akan membuat Anda semakin tertarik dan termotivasi.</p>
                        <a href="{{ route('login') }}" class="btn btn-mulai">Ayo mulai</a>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card shadow-none">
                                    <div class="card-body pt-2">
                                        <img src="{{ asset('assets/img/lencana.png') }}" width="64" height="64"
                                            alt="">
                                        <h6 class="title mt-4">Gamifikasi</h6>
                                        <p class="deskripsi">Mendapat poin disetiap ketuntasan dan dapat ditukarkan untuk
                                            mendapat kursus yang
                                            baru</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-none">
                                    <div class="card-body pt-2">
                                        <img src="{{ asset('assets/img/game.png') }}" width="64" height="64"
                                            alt="">
                                        <h6 class="title mt-4">Game Online</h6>
                                        <p class="deskripsi">Game yang dapat melatih dan mengasah ilmu yang didapat.
                                            layaknya bonus sehingga dapat menambah poin</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="berita" class="berita">
            <div class="container pt-4">
                <div class="text-center" style="margin-bottom: 50px">
                    <h3 class="title text-white">Berita nih</h3>
                    <p>jhgsdhjsgdsgdjh</p>
                    <p class="">Dapatkan dan baca berita terpercaya mengenai hal terkini yang relevan dengan
                        lingkungan sekitar.</p>
                </div>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <!-- Card 1 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/menteri-pendidikan.png') }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover"
                                            style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="title mt-4">Informasi dari pusat statistik bahwa kehiudapn bukan
                                                seuatu hal yang mulia</h5>
                                            <span style="font-size: 12px;font-weight: 500;color:gray">05 Juli 2024</span>
                                            <p class="card-text mt-2" style="font-size: 14px">Deskripsi singkat untuk card
                                                perjsdhhjsdg hjsdgshd gshdgsd
                                                jsjhdgh ertama. Deskripsi singkat
                                                untuk card pertamjshgdhjsgdj sgdjha. Deskbjshds ripsi singkat untuk card
                                                pertama.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card 2 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/thumbnail-default.jpg') }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card 2</h5>
                                            <p class="card-text">Deskripsi singkat untuk card kedua.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card 3 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}"
                                            class="card-img-top" style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card 3</h5>
                                            <p class="card-text">Deskripsi singkat untuk card ketiga.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <!-- Card 4 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/thumbnail-default.jpg') }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card 4</h5>
                                            <p class="card-text">Deskripsi singkat untuk card keempat.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card 5 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/kurmer.png') }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card 5</h5>
                                            <p class="card-text">Deskripsi singkat untuk card kelima.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card 6 -->
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img src="{{ asset('assets/img/develop.jpg') }}" class="card-img-top"
                                            style="height: 200px; object-fit: cover" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">Card 6</h5>
                                            <p class="card-text">Deskripsi singkat untuk card keenam.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
        </section>
        <section id="info" class="info">
            <div class="container pt-4">
                <div class="text-center">
                    <div class="text-center" style="margin-bottom: 50px">
                        <h3 class="title">Info</h3>
                        <p class="">Informasi terbaru yang layak kamu ketahui</p>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-4 col-sm-6">
                            <div class="card p-0 mb-1">
                                <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-img-overlay d-flex flex-column justify-content-end py-0">
                                    <h5 class="card-title text-start">Ini judul dari gddd ambarnyaa
                                        sdhgshdgsdjh
                                        jhsdgshjd
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card p-0 mb-1">
                                <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-img-overlay d-flex flex-column justify-content-end py-0">
                                    <h5 class="card-title text-start">Ini judul dari gddd ambarnyaa
                                        sdhgshdgsdjh
                                        jhsdgshjd
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card p-0 mb-1">
                                <img src="{{ asset('assets/img/develop.jpg') }}" class="card-img-top" alt="...">
                                <div class="card-img-overlay d-flex flex-column justify-content-end py-0">
                                    <h5 class="card-title text-start">Ini judul dari gddd ambarnyaa
                                        sdhgshdgsdjh
                                        jhsdgshjd
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="card p-0 mb-1">
                                <img src="{{ asset('assets/img/thumbnail-default.jpg') }}" class="card-img-top"
                                    alt="...">
                                <div class="card-img-overlay d-flex flex-column justify-content-end py-0">
                                    <h5 class="card-title text-start">Ini judul dari gddd ambarnyaa
                                        sdhgshdgsdjh
                                        jhsdgshjd
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <div class="footer">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <img src="{{ asset('NiceAdmin/assets/img/favicon.png') }}" alt="" srcset="">
                            <h6 class="mt-3">{{ env('APP_NAME') }}</h6>
                            <p>Media pembelajaran berbasis gamifikasi untuk mahasiswa PPG dalam mata kuliah prinsip
                                pengajaran dan assesmen di Sekolah Menengah Kejuruan</p>
                        </div>
                        <div class="col-md-2">
                            <div class="header-footer">
                                Fitur
                            </div>
                            <span>Gamifikasi</span>
                        </div>
                        <div class="col-md-3">
                            <div class="header-footer">
                                Hubungi Kami
                            </div>
                            <span>PPG Prajabatan</span>
                            <span>Universitas Negeri Malang</span>
                        </div>
                    </div>
                    <div class="copyright text-center text-white mt-4">
                        &copy; Copyright <strong><span>{{ env('APP_NAME') }}</span></strong>. All Rights Reserved
                    </div>
                </div>
            </div>
        </footer>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        @include('layouts.scripts.js')
    </body>

    </html>
