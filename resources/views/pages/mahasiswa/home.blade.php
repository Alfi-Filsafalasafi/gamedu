@extends('layouts.master')
@section('title', 'Home Mahasiswa')
@section('dashboard', 'nav-link')
@section('materi', 'nav-link collapsed')
@section('content')
    <section class="section dashboard">
        <div class="row">

            <!-- Admin Card -->
            <div class="col-12">
                <div class="card info-card customers-card">
                    <div class="card-body pt-4">
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-trophy"></i>
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
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="d-flex justify-content-between">
                                <i class="ri-lock-fill bg-danger text-white px-1 rounded" style="font-size: 20px"></i>
                                <small class="py-1 pe-3"><b class="text-secondary">pertemuan ke 4</b></small>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title m-0 py-2" style="font-size: 18px">Default Card</h5>
                                <p class="m-0 limited-text small">Ut in ea error laudantium quas omnis officia. Sit sed
                                    praesentium
                                    voluptas. Corrupti
                                    inventore
                                    consequatur nisi necessitatibus modi consequuntur soluta id. Enim autem est esse natus
                                    assumenda.</p>
                                <div class="d-flex justify-content-end mt-2 align-items-center">
                                    <i class="ri-money-dollar-box-fill text-success me-2" style="font-size: 24px"></i>
                                    <span class="me-4">{{ auth()->user()->uang ?? 0 }}</span>
                                    <a href="" class="btn btn-sm btn-success">Beli Materi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
