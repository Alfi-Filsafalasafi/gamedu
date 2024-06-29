@extends('layouts.master')
@section('title', 'Manajemen Materi')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link ')
@section('kuis', 'nav-link collapsed')
@section('tugas', 'nav-link collapsed')
@section('content')
    @include('sweetalert::alert')

    <div class="pagetitle">
        <h1>Manajemen Materi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
                <li class="breadcrumb-item active">Manajemen Materi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Materi</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan akun yang ada</p>
                        <a href="{{ route('dosen.bab.create') }}" class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="15%"><i class="bx bx-cog"></i></th>
                                        <th>Index</th>
                                        <th>Beli</th>
                                        <th>Nama</th>
                                        <th>Durasi</th>
                                        <th>Deskripsi</th>
                                        <th>CP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                <a href="{{ route('dosen.sub_bab.index', ['id_bab' => $data->id]) }}"
                                                    class="btn btn-primary btn-sm"><i class="bx bx-list-ul"></i></a>
                                                <a href="{{ route('dosen.bab.edit', ['id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                <a href="{{ route('dosen.bab.delete', ['id' => $data->id]) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $data->index }}</td>
                                            <td>{{ $data->beli_point ?? 0 }} poin</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->durasi }}</td>
                                            <td>{{ $data->deskripsi }}</td>
                                            <td>
                                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#modalCP{{ $data->id }}">
                                                    <i class="ri-eye-fill"></i>
                                                </button>

                                                <div class="modal fade" id="modalCP{{ $data->id }}" tabindex="-1"
                                                    aria-labelledby="modalCPLabel{{ $data->id }}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="modalCPLabel{{ $data->id }}">Capaian
                                                                    Pembelajaran</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                {!! $data->capaian_pembelajaran !!}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Tutup</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </td>
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
