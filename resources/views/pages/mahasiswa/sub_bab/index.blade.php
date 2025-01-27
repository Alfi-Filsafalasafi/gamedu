@extends('layouts.master')
@section('title', 'Materi Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')
@section('style')
    <style>
        .capaian img {
            width: 100%;
            height: auto;
        }

        @media (min-width: 768px) and (max-width: 992px) {
            .capaian img {
                width: 70%;
                height: auto;
            }
        }

        /* Untuk layar besar (> 992px) */
        @media (min-width: 992px) {
            .capaian img {
                width: 55%;
                height: auto;

            }
        }
    </style>
@endsection
@section('content')


    <section class="">
        <div class="row justify-content-between">
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
                            <li class="breadcrumb-item active">{{ $bab->nama }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class="" style="font-size: 20px"><b>{{ $total_point_user }}</b> /
                            {{ $total_point }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card p-0 mb-1">
                    <img src="{{ $bab->thumbnail != '' ? asset($bab->thumbnail) : asset('assets/img/thumbnail-default.jpg') }}"
                        style="height: 150px;object-fit: cover;" class="card-img-top" alt="...">
                    <div class="card-img-overlay d-flex flex-column justify-content-end">
                        <h5 class="card-title">{{ $bab->nama }}</h5>
                    </div>
                </div>
                <div class="alert fade show small pb-0 bg-white" role="alert">
                    <b>Capaian Pembelajaran</b>
                    <div class="capaian">
                        {!! $bab->capaian_pembelajaran !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row justify-content-between">
                    @if ($log_pre_test->isNotEmpty())
                        <div class="col-md-6">
                            <div class="card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class="ri-check-double-line bg-warning text-white px-2 py-1 rounded"
                                        style="font-size: 20px"></i>
                                    @if ($jumlah_benar_pre_test >= $jumlah_pre_test / 1.5)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                        </div>
                                    @elseif($jumlah_benar_pre_test >= $jumlah_pre_test / 2)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @elseif($jumlah_benar_pre_test >= $jumlah_pre_test / 8)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @else
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>

                                        <span class="" style="font-size: 16px"><b> {{ $jumlah_benar_pre_test }}
                                            </b>
                                            /
                                            {{ $jumlah_pre_test }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 pt-3 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        Pre-test
                                    </h5>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        <a href="{{ route('mahasiswa.quiz.index', ['id_bab' => $bab->id, 'id' => $pre_test->id]) }}"
                                            class="btn btn-sm btn-outline-primary">Akses Pre Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class="ri-edit-box-fill bg-primary text-white px-2 py-1 rounded"
                                        style="font-size: 20px"></i>
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                        <span class="" style="font-size: 16px"><b> 0 </b>
                                            /
                                            {{ $jumlah_pre_test }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 pt-3 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        Pre-test
                                    </h5>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        <a href="{{ route('mahasiswa.quiz.index', ['id_bab' => $bab->id, 'id' => $pre_test->id]) }}"
                                            class="btn btn-sm btn-outline-primary">Akses Pre Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($log_pre_test->isNotEmpty())
                        @foreach ($datas as $data)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        @if ($data->status == 'belumAda')
                                            <i class="ri-lock-fill bg-danger text-white px-2 py-1 rounded"
                                                style="font-size: 20px"></i>
                                        @elseif($data->status == 'progress')
                                            <i class="ri-door-open-fill bg-primary text-white px-2 py-1 rounded"
                                                style="font-size: 20px"></i>
                                        @elseif($data->status == 'selesai')
                                            <i class="ri-check-double-line bg-warning text-white px-2 py-1 rounded"
                                                style="font-size: 20px"></i>
                                            @if ($data->log_point_user >= $data->bintang_3)
                                                <div class="d-flex px-2 py-1 bg-emas rounded">
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                </div>
                                            @elseif($data->log_point_user >= $data->bintang_2)
                                                <div class="d-flex px-2 py-1 bg-emas rounded">
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                </div>
                                            @elseif($data->log_point_user >= $data->bintang_1)
                                                <div class="d-flex px-2 py-1 bg-emas rounded">
                                                    <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                </div>
                                            @else
                                                <div class="d-flex px-2 py-1 bg-emas rounded">
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                    <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="d-flex align-items-center me-3">
                                            <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                            <span class=""
                                                style="font-size: 16px"><b>{{ $data->log_point_user ?? 0 }}</b>
                                                /
                                                {{ $data->point_membaca + $data->point_menonton_yt + $data->point_tugas }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="m-0 pt-3 py-2 limited-text-title"
                                            style="font-size: 18px; color: #012970;">
                                            {{ $data->nama }}
                                        </h5>
                                        <div class="d-flex justify-content-end mt-2 align-items-center">
                                            @if ($data->status == 'belumAda')
                                                <form id="form-beli-sub-materi-{{ $data->id }}"
                                                    action="{{ route('mahasiswa.sub_bab.beli', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                                    method="POST" data-status="{{ $data->status }}">
                                                    @csrf
                                                    <input type="hidden" name="materi_id" value="{{ $data->id }}">
                                                    <i class="ri-money-dollar-box-fill text-success me-2"
                                                        style="font-size: 20px"></i>
                                                    <span class="me-4">{{ $data->beli_point ?? 0 }}</span>
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        Beli Materi
                                                    </button>
                                                </form>
                                            @else
                                                @if ($data->jumlah_revisi > 0)
                                                    <span class="badge bg-warning me-3">{{ $data->jumlah_revisi }}</span>
                                                @endif
                                                <a href="{{ route('mahasiswa.sub_bab.baca', ['id_bab' => $data->id_bab, 'id' => $data->id]) }}"
                                                    class="btn btn-sm btn-outline-primary">Baca Materi</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        @foreach ($datas as $data)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class="ri-lock-fill bg-danger text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                        <div class="d-flex align-items-center me-3">
                                            <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                            <span class="" style="font-size: 16px"><b>0</b>
                                                /
                                                {{ $data->point_membaca + $data->point_menonton_yt + $data->point_tugas }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="m-0 pt-3 py-2 limited-text-title"
                                            style="font-size: 18px; color: #012970;">
                                            {{ $data->nama }}
                                        </h5>
                                        <div class="d-flex justify-content-end mt-2 align-items-center">
                                            <i class="ri-money-dollar-box-fill text-success me-2"
                                                style="font-size: 20px"></i>
                                            <span class="me-4">{{ $data->beli_point ?? 0 }}</span>
                                            <button type="submit" class="btn btn-sm btn-dark" disabled>
                                                Beli Materi
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if ($log_post_test->isNotEmpty())
                        <div class="col-md-6">
                            <div class="card">
                                <div class="d-flex justify-content-between align-items-center">
                                    <i class="ri-check-double-line bg-warning text-white px-2 py-1 rounded"
                                        style="font-size: 20px"></i>
                                    @if ($jumlah_benar_post_test >= $jumlah_post_test / 1.5)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                        </div>
                                    @elseif($jumlah_benar_post_test >= $jumlah_post_test / 2)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @elseif($jumlah_benar_post_test >= $jumlah_post_test / 8)
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-warning" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @else
                                        <div class="d-flex px-2 py-1 bg-emas rounded">
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                            <i class="ri-star-fill text-gray" style="font-size:20px"></i>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>

                                        <span class="" style="font-size: 16px"><b> {{ $jumlah_benar_post_test }}
                                            </b>
                                            /
                                            {{ $jumlah_post_test }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 pt-3 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        Post-test
                                    </h5>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        <a href="{{ route('mahasiswa.quiz.index', ['id_bab' => $bab->id, 'id' => $post_test->id]) }}"
                                            class="btn btn-sm btn-outline-primary">Akses Post Test</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="card">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($openPostTest)
                                        <i class="ri-edit-box-fill bg-primary text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                    @else
                                        <i class="ri-lock-fill bg-danger text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                    @endif

                                    <div class="d-flex align-items-center me-3">
                                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                        <span class="" style="font-size: 16px"><b> 0 </b>
                                            /
                                            {{ $jumlah_post_test }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 pt-3 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        Post-test
                                    </h5>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        @if ($openPostTest)
                                            <a href="{{ route('mahasiswa.quiz.index', ['id_bab' => $bab->id, 'id' => $post_test->id]) }}"
                                                class="btn btn-sm btn-outline-primary">Akses Post Test</a>
                                        @else
                                            <button class="btn btn-sm btn-dark" disabled>Akses Post Test</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-4">
                @include('layouts.partials.peringkat')
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var forms = document.querySelectorAll('[id^=form-beli-sub-materi]');

            forms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    var status = this.getAttribute('data-status');

                    if (status === 'belumAda') {
                        swal({
                            title: "Apakah kamu ingin membeli materi ini?",
                            text: "Pastikan point anda cukup untuk membeli ini.",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        }).then((willBuy) => {
                            if (willBuy) {
                                this.submit();
                            }
                        });
                    } else {
                        // Tidak melakukan apa-apa karena sudah menampilkan tombol "Akses Materi"
                    }
                });
            });
        });
    </script>
@endsection
