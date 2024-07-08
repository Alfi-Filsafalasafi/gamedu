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
            @endauth
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
                <h3 class="title text-white">Berita</h3>
                <p class="">Dapatkan dan baca berita terpercaya mengenai hal terkini yang relevan dengan
                    lingkungan sekitar.</p>
            </div>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <!-- Carousel Indicators -->
                <div class="carousel-indicators">
                    @foreach ($beritas->chunk(3) as $chunkIndex => $beritaChunk)
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $chunkIndex }}" class="{{ $chunkIndex == 0 ? 'active' : '' }}"
                            aria-current="{{ $chunkIndex == 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $chunkIndex + 1 }}">
                        </button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($beritas->chunk(3) as $chunkIndex => $beritaChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="row">
                                @foreach ($beritaChunk as $berita)
                                    <div class="col-lg-4">
                                        <a href="">
                                            <div class="card">
                                                <img src="{{ asset($berita->photo) }}" class="card-img-top"
                                                    style="height: 200px; object-fit: cover"
                                                    alt="{{ $berita->judul }}">
                                                <div class="card-body">
                                                    <h5 class="title mt-4">{{ $berita->judul }}</h5>
                                                    <span
                                                        style="font-size: 12px;font-weight: 500;color:gray">{{ \Carbon\Carbon::parse($berita->updated_at)->translatedFormat('d F Y') }}</span>
                                                    <p class="card-text mt-2" style="font-size: 14px">
                                                        {{ $berita->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

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
                    @forelse ($infos as $info)
                        <div class="col-md-4 col-sm-6">
                            <div class="card p-0 mb-4">
                                <img src="{{ asset($info->photo) }}" class="card-img-top" alt="...">
                                <div class="card-img-overlay d-flex flex-column justify-content-end py-0">
                                    <h5 class="card-title text-start">
                                        <div class="text-informasi">
                                            {{ $info->judul }}
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="text-center">~~ Tidak ada data ~~</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    @include('layouts.landing_page.footer')


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.scripts.js')
</body>

</html>
