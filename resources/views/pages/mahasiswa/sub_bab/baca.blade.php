@extends('layouts.master')
@section('title', 'Materi Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('content')
    <section class="section">
        <div class="row">
            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-start">
                    <nav>
                        <h1>Materi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.bab.index') }}">Materi</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('mahasiswa.sub_bab.index', ['id_bab' => $bab->id]) }}">{{ $bab->nama }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $data->nama }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class="" style="font-size: 24px"><b>{{ auth()->user()->uang ?? 0 }}</b> /
                            {{ $data->point_membaca + $data->point_menonton_yt + $data->point_tugas }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <h3>{{ $data->nama }}</h3>
                            <div class="d-flex align-items-center">
                                <i class="bx bx-history" style="font-size:24px"></i>
                                <small class="mx-2 mb-0">{{ $data->min_akses_materi }}</small>
                                <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                <strong class="ms-2 mb-0">{{ $data->point_membaca }}</strong>
                            </div>
                        </div>
                        {!! $data->content !!}

                        <div class="d-flex justify-content-end">
                            <form class="forms-sample" action="" method="POST">
                                @csrf
                                <span id="timerMembaca" class="me-3"></span>
                                <button type="submit" class="btn btn-sm btn-outline-primary btn-fw" id="membacaId"
                                    disabled>Selesai</button>
                            </form>
                        </div>
                    </div>
                </div>
                @if ($data->link_yt)
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong>Silahkan simak video di bawah ini</strong>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-history" style="font-size:24px"></i>
                                    <small class="mx-2 mb-0">{{ $data->min_akses_yt }}</small>
                                    <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                    <strong class="ms-2 mb-0">{{ $data->point_menonton_yt }}</strong>
                                </div>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 my-2">
                                <div id="player"></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <form class="forms-sample" action="" method="POST">
                                    @csrf
                                    <span id="timerYt" class="me-3"></span>
                                    <button type="submit" class="btn btn-sm btn-outline-primary btn-fw" id="ytId"
                                        disabled>Selesai</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="mb-2">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong>Tugas</strong>
                                <div class="d-flex align-items-center">
                                    <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                    <strong class="ms-2 mb-0">{{ $data->point_tugas }}</strong>
                                </div>
                            </div>
                        </div>
                        {!! $data->uraian_tugas !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var AksesMateri = @json($data->min_akses_materi);
            var AksesYt = @json($data->min_akses_yt);
            var countdownTimerMembaca;
            var countdownTimerYt;

            function startCountdownMembaca() {
                var countDownDate = new Date().getTime() + (AksesMateri * 1000);
                countdownTimerMembaca = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("timerMembaca").innerHTML = minutes + "m " + seconds + "s ";

                    // Aktifkan tombol setelah waktu habis
                    if (distance < 0) {
                        clearInterval(countdownTimerMembaca);
                        document.getElementById("timerMembaca").innerHTML = "";
                        document.getElementById("membacaId").disabled = false;
                    }
                }, 1000); // Update setiap detik
            }

            function startCountdownYt() {
                var countDownDate = new Date().getTime() + (AksesYt * 1000);
                countdownTimerYt = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countDownDate - now;

                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("timerYt").innerHTML = minutes + "m " + seconds + "s ";

                    // Aktifkan tombol setelah waktu habis
                    if (distance < 0) {
                        clearInterval(countdownTimerYt);
                        document.getElementById("timerYt").innerHTML = "";
                        document.getElementById("ytId").disabled = false;
                    }
                }, 1000); // Update setiap detik
            }

            // Panggil fungsi untuk memulai countdown membaca
            startCountdownMembaca();

            // Load YouTube API IFrame
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            // Inisialisasi player YouTube
            var player;
            window.onYouTubeIframeAPIReady = function() {
                var videoUrl = '{{ $data->link_yt }}'; // Isi dari $data->link_yt
                var videoId = videoUrl.split('/').pop().split('?')[0]; // Mendapatkan ID video dari URL

                player = new YT.Player('player', {
                    height: '390',
                    width: '100%',
                    videoId: videoId,
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            };

            function onPlayerReady(event) {
                // Video siap untuk diputar
            }

            // Fungsi untuk mendeteksi perubahan status player
            var pernahPutar = false;

            function onPlayerStateChange(event) {
                if (event.data == YT.PlayerState.PLAYING) {
                    if (!pernahPutar) {
                        startCountdownYt();
                        pernahPutar = true;
                    }
                }
            }
        });
    </script>
@endsection
