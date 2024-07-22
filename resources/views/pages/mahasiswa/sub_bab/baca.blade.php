@extends('layouts.master')
@section('title', 'Materi Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')
@section('style')
    <style>
        .content img {
            width: 100%;
            height: auto;
        }

        .tugas img {
            width: 100%;
            height: auto;
        }

        /* Untuk layar medium (768px - 992px) */
        @media (min-width: 768px) and (max-width: 992px) {
            .content img {
                width: 80%;
                height: auto;
            }

            .tugas img {
                width: 70%;
                height: auto;
            }
        }

        /* Untuk layar besar (> 992px) */
        @media (min-width: 992px) {
            .content img {
                width: 75%;
                height: auto;

            }

            .tugas img {
                width: 100%;
                height: auto;
            }
        }
    </style>
@endsection
@section('content')


    <section class="section">
        <div class="row">
            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-start">
                    <nav>
                        <h1>Materi</h1>
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
                            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.bab.index') }}">Materi</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('mahasiswa.sub_bab.index', ['id_bab' => $bab->id]) }}">{{ $bab->nama }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $data->nama }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class=""
                            style="font-size: 24px"><b>{{ $logSubBabUser->point_membaca + $logSubBabUser->point_menonton_yt + $logSubBabUser->point_tugas }}</b>
                            /
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
                                <span class="ms-2 mb-0"><b>{{ $logSubBabUser->point_membaca ?? 0 }}</b> /
                                    {{ $data->point_membaca }} </span>
                            </div>
                        </div>
                        <div class="content">
                            {!! $data->content !!}
                        </div>

                        <div class="d-flex justify-content-end">
                            @if ($logSubBabUser->point_membaca == null || $logSubBabUser->point_membaca == 0)
                                <form class="forms-sample"
                                    action="{{ route('mahasiswa.sub_bab.selesaiBaca', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                    method="POST" id="selesaiBacaForm">
                                    @csrf
                                    @method('PATCH')
                                    <span id="timerMembaca" class="me-3"></span>
                                    <button type="button" class="btn btn-sm btn-outline-primary btn-fw mt-2" id="membacaId"
                                        onclick="confirmMembaca()" disabled>Selesai</button>
                                </form>
                            @else
                                <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>
                                <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>
                                <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>

                                <button type="button" class="btn btn-sm btn-outline-secondary btn-fw mt-2 ms-3"
                                    disabled>Sudah
                                    Selesai</button>
                            @endif
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
                                    <span class="ms-2 mb-0"> <b>{{ $logSubBabUser->point_menonton_yt ?? 0 }} </b> /
                                        {{ $data->point_menonton_yt }}</span>
                                </div>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 my-2">
                                <div id="player"></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                @if ($logSubBabUser->point_menonton_yt == null || $logSubBabUser->point_menonton_yt == 0)
                                    <form class="forms-sample"
                                        action="{{ route('mahasiswa.sub_bab.selesaiMenontonYt', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                        method="POST" id="selesaiMenontonYtForm">
                                        @csrf
                                        @method('PATCH')
                                        <span id="timerYt" class="me-3"></span>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-2 btn-fw"
                                            id="ytId" onclick="confirmMenontonYt()" disabled>Selesai</button>
                                    </form>
                                @else
                                    <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>
                                    <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>
                                    <i class="ri-star-fill" style="color:#ffd700; font-size:24px"></i>

                                    <button type="button" class="btn btn-sm btn-outline-secondary btn-fw mt-2 ms-3"
                                        disabled>Sudah
                                        Selesai</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                @if ($data->lampiran_pdf)
                    <div class="card">
                        <div class="card-body mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <strong>Lampiran Materi</strong>
                            </div>
                            <div class="embed-responsive embed-responsive-16by9 my-2">
                                <embed src="{{ asset($data->lampiran_pdf) }}" type="application/pdf" width="100%"
                                    height="600px">
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body mt-3">
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <strong>Tugas</strong>
                                        <div class="d-flex align-items-center">
                                            <i class="ri-copper-coin-fill" style="color:#ffd700; font-size:24px"></i>
                                            <span class="ms-2 mb-0"> <b>{{ $logSubBabUser->point_tugas ?? 0 }} </b> /
                                                {{ $data->point_tugas }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tugas">
                                    {!! $data->uraian_tugas !!}
                                </div>
                                @if ($logSubBabUser->status_tugas == '')
                                    <small><b>Pengumpulan tugas</b></small>

                                    <form class="needs-validation"
                                        action="{{ route('mahasiswa.sub_bab.pengumpulanTugas', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                        method="POST" id="pengumpulanTugasForm" enctype="multipart/form-data"
                                        novalidate>
                                        @csrf
                                        @method('PATCH')
                                        <input class="form-control mt-2" name="file_tugas" type="file" id="formFile"
                                            required />
                                        <button type="button" class="btn btn-sm btn-primary w-100 btn-fw mt-2"
                                            id="tugasId" onclick="pengumpulanTugas()">Submit</button>
                                    </form>
                                @elseif($logSubBabUser->status_tugas == 'submit')
                                    <small>file tugas anda</small> <br>
                                    <a
                                        href="{{ asset($logSubBabUser->file_tugas) }}">{{ basename($logSubBabUser->file_tugas) }}</a>
                                    <div class="alert alert-info mt-2" role="alert">
                                        <i class="bi bi-info-circle me-1"></i>
                                        <small>Tugas anda akan direview oleh dosen, silahkan ditunggu</small>
                                    </div>
                                @elseif($logSubBabUser->status_tugas == 'revisi')
                                    <small>file tugas anda</small> <br>
                                    <a
                                        href="{{ asset($logSubBabUser->file_tugas) }}">{{ basename($logSubBabUser->file_tugas) }}</a>
                                    <div class="alert alert-warning mt-2" role="alert">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <small>Anda harus merevisi tugas dan mengumpulkan hasil revisian</small>
                                    </div>
                                    <div class="alert alert-warning mt-2" role="alert">
                                        <small><b>Catatan dosen :</b>
                                            {!! $logSubBabUser->catatan_tugas !!}
                                        </small>
                                    </div>
                                    <small><b>Pengumpulan tugas hasil revisi</b></small>

                                    <form class="needs-validation"
                                        action="{{ route('mahasiswa.sub_bab.pengumpulanTugas', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                        method="POST" id="pengumpulanTugasForm" enctype="multipart/form-data"
                                        novalidate>
                                        @csrf
                                        @method('PATCH')
                                        <input class="form-control mt-2" name="file_tugas" type="file" id="formFile"
                                            required />
                                        <button type="button" class="btn btn-sm btn-primary w-100 btn-fw mt-2"
                                            id="tugasId" onclick="pengumpulanTugas()">Submit</button>
                                    </form>
                                @elseif($logSubBabUser->status_tugas == 'selesai')
                                    <small>file tugas anda</small> <br>
                                    <a
                                        href="{{ asset($logSubBabUser->file_tugas) }}">{{ basename($logSubBabUser->file_tugas) }}</a>
                                    <div class="alert alert-success mt-2" role="alert">
                                        <i class="bi bi-check-circle me-1"></i>
                                        <small>Tugas anda telah diterima dan nilai oleh dosen</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body mt-3">
                                <div class="mb-2">
                                    <strong>Rublik Penilaian</strong>
                                </div>
                                <div class="tugas">
                                    @if ($data->rublik_penilaian == null)
                                        Tidak ada
                                    @else
                                        {!! $data->rublik_penilaian !!}
                                    @endif
                                </div>
                            </div>
                        </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmMembaca() {
            Swal.fire({
                title: 'Apakah Anda yakin telah membaca?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, telah selesai!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selesaiBacaForm').submit();
                }
            });
        }

        function confirmMenontonYt() {
            Swal.fire({
                title: 'Apakah Anda yakin telah menonton?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, telah selesai!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('selesaiMenontonYtForm').submit();
                }
            });
        }

        function pengumpulanTugas() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin mengumpulkan tugas dengan file ini?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, saya yakin!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var fileInput = document.getElementById('formFile');
                    var file = fileInput.files[0];

                    if (file && file.size > 2 * 1024 * 1024) { // 2 MB in bytes
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gambar Tidak boleh lebih dari 2MB'
                        });
                        event.preventDefault(); // Prevent form submission
                    } else {
                        document.getElementById('pengumpulanTugasForm').submit();

                    }
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script></script>
@endsection
