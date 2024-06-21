@extends('layouts.master')
@section('title', 'Manajemen Kuis')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('kuis', 'nav-link')
@section('content')
    @include('sweetalert::alert')

    <div class="pagetitle">
        <h1>Manajemen Kuis</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active">Manajemen Kuis</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Kuis</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan akun yang ada</p>
                        <a href="{{ route('dosen.quiz.create') }}" class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="15%"><i class="bx bx-cog"></i></th>
                                        <th>Nama Materi</th>
                                        <th>Tipe</th>
                                        <th>Petunjuk Pengerjaan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                <a href="{{ route('dosen.quiz.edit', ['id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                <a href="{{ route('dosen.quiz.delete', ['id' => $data->id]) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $data->bab->nama }}</td>
                                            <td>{{ $data->type }}</td>
                                            <td>{{ $data->petunjuk_pengerjaan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Memuat Bootstrap JS (termasuk file js-bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
