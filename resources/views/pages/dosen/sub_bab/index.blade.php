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
                <li class="breadcrumb-item"><a href="{{ route('dosen.bab.index') }}">Manajemen Materi</a> </li>
                <li class="breadcrumb-item active">{{ $bab->nama }}</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Materi / {{ $bab->nama }}</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan akun yang ada</p>
                        <a href="{{ route('dosen.sub_bab.create', ['id_bab' => $bab->id]) }}"
                            class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="15%"><i class="bx bx-cog"></i></th>
                                        <th>Index</th>
                                        <th>Beli</th>
                                        <th>Nama</th>
                                        <th>Point Membaca</th>
                                        <th>Point Menonton</th>
                                        <th>Point Tugas</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>

                                                <a href="{{ route('dosen.sub_bab.edit', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                <a href="{{ route('dosen.sub_bab.delete', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                            </td>
                                            <td>{{ $data->index }}</td>
                                            <td>{{ $data->beli_point ?? 0 }} poin</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>{{ $data->point_membaca }}</td>
                                            <td>{{ $data->point_menonton_yt ?? '-' }}</td>
                                            <td>{{ $data->point_tugas }}</td>
                                            <td>
                                                <a href="{{ route('dosen.sub_bab.show', ['id_bab' => $bab->id, 'id' => $data->id]) }}"
                                                    class="btn btn-info btn-sm"><i class="ri-eye-fill"></i></a>

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

@endsection
