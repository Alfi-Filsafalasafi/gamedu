@extends('layouts.master')
@section('title', 'Home Admin')
@section('dashboard', 'nav-link')
@section('user', 'nav-link collapsed')
@section('berita', 'nav-link collapsed')
@section('info', 'nav-link collapsed')
@section('content')
    <section class="section dashboard">
        <div class="row">

            <!-- Admin Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="filter">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            Admin <span>| Jumlah saat ini</span>
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $admin }}</h6>
                                @if ($adminHariIni != 0)
                                    <span class="text-success small pt-1 fw-bold">+{{ $adminHariIni }}</span>
                                    <span class="text-muted small pt-2 ps-1">akun</span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Admin Card -->
            <!-- Dosen Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card customers-card">
                    <div class="filter">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            Dosen <span>| Jumlah saat ini</span>
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $dosen }}</h6>
                                @if ($dosenHariIni != 0)
                                    <span class="text-success small pt-1 fw-bold">+{{ $dosenHariIni }}</span>
                                    <span class="text-muted small pt-2 ps-1">akun</span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Dosen Card -->
            <!-- Mahasiswa Card -->
            <div class="col-lg-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="filter">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">
                            Mahasiswa <span>| Jumlah saat ini</span>
                        </h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $mahasiswa }}</h6>
                                @if ($mahasiswaHariIni != 0)
                                    <span class="text-success small pt-1 fw-bold">+{{ $mahasiswaHariIni }}</span>
                                    <span class="text-muted small pt-2 ps-1">akun</span>
                                @else
                                    <span class="text-muted small pt-2 ps-1">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Mahasiswa Card -->
        </div>
        <div class="row justify-content-center">

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Log Kunjungan User</h5>

                        <!-- Area Chart -->
                        <div id="areaChart"></div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const dates = @json($dates);
                                const prices = @json($prices);

                                new ApexCharts(document.querySelector("#areaChart"), {
                                    series: [{
                                        name: "Jumlah Pengunjung",
                                        data: prices
                                    }],
                                    chart: {
                                        type: 'area',
                                        height: 350,
                                        zoom: {
                                            enabled: false
                                        }
                                    },
                                    dataLabels: {
                                        enabled: false
                                    },
                                    stroke: {
                                        curve: 'straight'
                                    },
                                    subtitle: {
                                        text: 'Log Kunjungan',
                                        align: 'left'
                                    },
                                    labels: dates,
                                    xaxis: {
                                        type: 'category', // Menggunakan kategori karena bukan data waktu
                                        categories: dates, // Kategori tanggal yang tepat
                                    },
                                    yaxis: {
                                        opposite: true,
                                        min: 0
                                    },
                                    legend: {
                                        horizontalAlign: 'left'
                                    }
                                }).render();
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

@endsection
