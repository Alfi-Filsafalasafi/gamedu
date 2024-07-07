@extends('layouts.master')
@section('title', 'Home Mahasiswa')
@section('dashboard', 'nav-link')
@section('materi', 'nav-link collapsed')
@section('games', 'nav-link collapsed')
@section('peringkat', 'nav-link collapsed')
@section('content')


    <section class="section dashboard">
        <div class="row">

            <!-- Admin Card -->
            <div class="col-12">
                <div class="card info-card customers-card">
                    <div class="card-body pt-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-stars"></i>
                            </div>
                            <div class="ps-3">
                                <h6 style="font-size: 18px">Semangat Anak Muda</h6>
                                <span class="text-muted small pt-2">Setiap detik belajar membawa kita lebih dekat pada
                                    kesuksesan. Mari tingkatkan giat belajar kita, pahami setiap konsep, dan latih
                                    keterampilan kita. Belajar adalah panggung untuk memamerkan potensi kita, dan kita siap
                                    membuat penampilan yang tak terlupakan!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row justify-content-between">
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="">
                        <h4>Materi</h4>
                        <p>Berikut adalah materi-materi yang dapat kamu pelajari, semangat dan semoga sukses</p>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 24px"></i>
                        <span class=""
                            style="font-size: 20px; white-space: nowrap;"><b>{{ $total_point_user ?? 0 }}</b>
                            /{{ $total_point }}</span>
                    </div>

                </div>
                <div class="row justify-content-between">
                    @foreach ($datas as $data)
                        <div class="col-md-6">
                            <div class="card">
                                <img src="{{ $data->thumbnail != '' ? asset($data->thumbnail) : asset('assets/img/thumbnail-default.jpg') }}"
                                    class="card-img-top" style="height: 150px; object-fit: cover;" alt="...">
                                <div class="d-flex justify-content-between align-items-center">
                                    @if ($data->status == 'belumAda')
                                        <i class="ri-lock-fill bg-danger text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                    @elseif($data->status == 'progress')
                                        <i class="ri-door-open-fill bg-primary text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                    @elseif($data->status == 'selesai')
                                        <i class="ri-check-double-line bg-success text-white px-2 py-1 rounded"
                                            style="font-size: 20px"></i>
                                    @endif
                                    <div class="d-flex align-items-center me-3">
                                        <i class="ri-copper-coin-fill text-warning me-2" style="font-size: 20px"></i>
                                        <span class=""
                                            style="font-size: 16px"><b>{{ $data->total_point_user ?? 0 }}</b> /
                                            {{ $data->subBabs->sum('point_membaca') + $data->subBabs->sum('point_menonton_yt') + $data->subBabs->sum('point_tugas') }}</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="m-0 py-2 limited-text-title" style="font-size: 18px; color: #012970;">
                                        {{ $data->nama }}
                                    </h5>
                                    <p class="m-0 limited-text small">{{ $data->durasi }}</p>
                                    <div class="d-flex justify-content-end mt-2 align-items-center">
                                        @if ($data->status == 'belumAda')
                                            <form id="form-beli-materi-{{ $data->id }}"
                                                action="{{ route('mahasiswa.bab.beli', ['id' => $data->id]) }}"
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
                                            <a href="{{ route('mahasiswa.sub_bab.index', ['id_bab' => $data->id]) }}"
                                                class="btn btn-sm btn-outline-primary">Akses Materi</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
            var forms = document.querySelectorAll('[id^=form-beli-materi]');

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
