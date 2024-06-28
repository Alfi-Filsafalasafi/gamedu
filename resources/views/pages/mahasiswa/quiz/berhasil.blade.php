@extends('layouts.master')
@section('title', 'Materi Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')

@section('content')
    @include('sweetalert::alert')

    <section class="">
        <div class="row justify-content-between">
            <div class="pagetitle">
                <div class="d-flex justify-content-between align-items-start">
                    <nav>
                        <h1>Materi</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mahasiswa.bab.index') }}">Materi</a></li>
                            <li class="breadcrumb-item"><a
                                    href="{{ route('mahasiswa.sub_bab.index', ['id_bab' => $quiz->bab->id]) }}">{{ $quiz->bab->nama }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ $quiz->type }}</li>
                        </ol>
                    </nav>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 28px"></i>
                        <span class="" style="font-size: 20px"><b>{{ $total_point_user ?? 0 }}</b> /
                            {{ $jumlah_point ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body mt-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="">
                                <div class="align-items-center">
                                    <small> <b>{{ $quiz->bab->nama }} </b></small>
                                    <h4> {{ $quiz->type }}</h4>
                                    <p class="">{{ $quiz->petunjuk_pengerjaan }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-rounded border border-success">
                    <div class="card-body mt-2">
                        <b>Berhasil !</b> <br>
                        <small>Jawaban Anda telah terkirim. Anda dapat melihat nilai pada point di atas. Anda dapat
                            melanjutkan
                            materi dengan mengeklik tombol berikut</small>
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('mahasiswa.sub_bab.index', ['id_bab' => $quiz->bab->id]) }}"
                                class="btn btn-sm btn-outline-primary btn-fw">Kembali Ke Materi</a>
                        </div>

                    </div>
                </div>
                <div class="row mt-3">
                    @foreach ($datas as $quizIndex => $quiz)
                        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                                <div class="card-body pt-3">
                                    <div class="d-flex align-items-start">
                                        <p><b class="me-2">{{ $loop->iteration }}</b>. </p>
                                        <div class="m-1">
                                            {!! $quiz->subQuiz->pertanyaan !!}
                                        </div>
                                    </div>
                                    <div class="form-group ms-4">
                                        @foreach (range('a', 'e') as $jawabanIndex)
                                            <div class="form-check">
                                                <div class="d-flex">
                                                    <input type="hidden"
                                                        name="jawaban[{{ $quizIndex }}][id_pertanyaan]"
                                                        value="{{ $quiz->subQuiz->id }}">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input"
                                                            name="jawaban[{{ $quizIndex }}][jawaban]"
                                                            value="{{ $jawabanIndex }}"
                                                            @if ($jawabanIndex == $quiz->jawaban) checked @else disabled @endif />
                                                    </label>
                                                    {!! $quiz->subQuiz->{'jawaban_' . strtolower($jawabanIndex)} !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($quiz->is_benar == true)
                                        <div class="alert alert-success py-2 px-3">
                                            <small> <b>Kunci Jawaban : {{ $quiz->subQuiz->kunci_jawaban }}</b> </small>
                                        </div>
                                    @else
                                        <div class="alert alert-danger py-2 px-3">
                                            <small> <b>Jawaban yang Benar : {{ $quiz->subQuiz->kunci_jawaban }}</b>
                                            </small>
                                        </div>
                                    @endif

                                    @if ($errors->has("jawaban.$quizIndex.jawaban"))
                                        <div class="alert alert-danger">
                                            <p>Jawaban tidak boleh kosong</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>



            </div>

        </div>

    </section>
@endsection

@section('scripts')
@endsection
