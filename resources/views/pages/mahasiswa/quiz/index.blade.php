@extends('layouts.master')
@section('title', 'Materi Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')
<style>
    .pertanyaan img {
        width: 100%;
        height: auto;
    }

    .jawaban img {
        width: 100%;
        height: auto;
    }

    /* Untuk layar medium (768px - 992px) */
    @media (min-width: 768px) and (max-width: 992px) {
        .pertanyaan img {
            width: 60%;
            height: auto;
        }

        .jawaban img {
            width: 60%;
            height: auto;
        }
    }

    /* Untuk layar besar (> 992px) */
    @media (min-width: 992px) {
        .pertanyaan img {
            width: 55%;
            height: auto;

        }

        .jawaban img {
            width: 55%;
            height: auto;

        }
    }
</style>
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
                <div class="row flex-grow mt-3">
                    <form method="POST" id="formQuiz"
                        action="{{ route('mahasiswa.quiz.submitJawaban', ['id_bab' => $quiz->bab->id, 'id' => $quiz->id]) }}">
                        @csrf

                        @foreach ($datas as $quizIndex => $quiz)
                            <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body pt-3">
                                        <div class="d-flex align-items-start">
                                            <p><b class="me-2">{{ $loop->iteration }}</b>. </p>
                                            <div class="pertanyaan m-1">
                                                {!! $quiz->pertanyaan !!}
                                            </div>
                                        </div>
                                        <div class="form-group ms-4">
                                            @foreach (range('a', 'e') as $jawabanIndex)
                                                <div class="form-check">
                                                    <div class="d-flex">
                                                        <input type="hidden"
                                                            name="jawaban[{{ $quizIndex }}][id_pertanyaan]"
                                                            value="{{ $quiz->id }}">
                                                        <input type="radio" class="form-check-input"
                                                            id="jawaban_{{ $quizIndex }}_{{ $jawabanIndex }}"
                                                            name="jawaban[{{ $quizIndex }}][jawaban]"
                                                            value="{{ $jawabanIndex }}"
                                                            @if (old("jawaban.$quizIndex.jawaban") == $jawabanIndex) checked @endif />
                                                        <label class="form-check-label ms-3 jawaban"
                                                            for="jawaban_{{ $quizIndex }}_{{ $jawabanIndex }}">
                                                            {!! $quiz->{'jawaban_' . strtolower($jawabanIndex)} !!}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        @if ($errors->has("jawaban.$quizIndex.jawaban"))
                                            <div class="alert alert-danger">
                                                Jawaban tidak boleh kosong
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-end">
                            <button id="submitBtn" type="submit"
                                class="btn btn-sm btn-outline-primary btn-fw">Submit</button>
                        </div>
                    </form>





                </div>
            </div>

        </div>

    </section>
@endsection

@section('scripts')
    <script>
        document.getElementById('formQuiz').addEventListener('submit', function() {
            var submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Loading...'; // Mengubah teks tombol menjadi 'Loading...'
        });
    </script>
@endsection
