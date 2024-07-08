<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Laravel') }}</title>

    @include('layouts.scripts.css')

    <style>
        .content img {
            width: 100%;
            height: auto;
        }

        /* Untuk layar medium (768px - 992px) */
        @media (min-width: 768px) and (max-width: 992px) {
            .content img {
                width: 80%;
                height: auto;
            }
        }

        /* Untuk layar besar (> 992px) */
        @media (min-width: 992px) {
            .content img {
                width: 75%;
                height: auto;

            }
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>



<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="d-flex navbar-brand align-items-center order-sm-1" href="{{ route('welcome') }}">
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
    <main style="padding-top: 100px">
        <div class="container">

            <div class="row">
                <div class="col-md-8 mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                        <li class="breadcrumb-item active">Berita</li>
                    </ol>
                    <h3 class="title">{{ $data->judul }}</h3>
                    <div class="my-3" style="font-size: 14px">{{ $data->admin->name }} |
                        {{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y H:i:s') }}
                    </div>
                    <img src="{{ asset($data->photo) }}"class="w-100 mt-2 my-4" alt="" srcset="">
                    <div class="content">
                        {!! $data->content !!}
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="title mb-4">Berita Terkini</div>
                    @forelse ($beritas as $data)
                        <a href="{{ route('berita', ['id' => $data->id]) }}">
                            <div class="card mb-3 shadow-none">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset($data->photo) }}" class="img-fluid rounded-start h-100"
                                            alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body pt-2 mb-0 pb-2">
                                            <div class="title card-title-berita">{{ $data->judul }}</div>
                                            <p class="deskripsi card-text-berita p-0 m-0">{{ $data->deskripsi }}</p>
                                            <small
                                                style="font-size:10px;">{{ \Carbon\Carbon::parse($data->updated_at)->translatedFormat('d F Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="tex-center">~~ Tidak ada data ~~</div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>

    @include('layouts.landing_page.footer')

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.scripts.js')
</body>

</html>
