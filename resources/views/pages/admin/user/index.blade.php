@extends('layouts.master')
@section('title', 'Manajemen Akun')
@section('dashboard', 'nav-link collapsed')
@section('user', 'nav-link')
@section('berita', 'nav-link collapsed')
@section('info', 'nav-link collapsed')

@section('content')


    <div class="pagetitle">
        <h1>Manajemen Akun</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Manajemen Akun</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Akun</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan akun yang ada</p>
                        <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="10%"><i class="bx bx-cog"></i></th>
                                        <th>Img</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Prodi</th>
                                        <th>Angkatan</th>
                                        <th>Role</th>
                                        <th>Token Dosen</th>
                                        <th>Dosen Anda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>

                                                <a href="{{ route('admin.user.edit', ['id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                @if ($data->id == auth()->user()->id)
                                                    <a href="#" class="btn btn-secondary btn-sm" disabled>
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ route('admin.user.delete', ['id' => $data->id]) }}"
                                                        class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                        <i class="bx bxs-trash"></i>
                                                    </a>
                                                @endif
                                                </form>
                                            </td>
                                            <td>
                                                @if ($data->photo)
                                                    <img src="{{ asset($data->photo) }}" alt="" style="width: 24px">
                                                @else
                                                    <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}"
                                                        alt="" style="width: 24px">
                                                @endif
                                            </td>
                                            <td>{{ $data->name }}</td>
                                            <td>{{ $data->email }}</td>
                                            <td>{{ $data->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                            <td>{{ $data->prodi ? $data->prodi : '-' }}</td>
                                            <td>{{ $data->angkatan ? $data->angkatan : '-' }}</td>
                                            <td>{{ $data->role }}</td>
                                            <td>{{ $data->token_dosen ?? '-' }}</td>
                                            <td>{{ $data->dosen->name ?? '-' }}</td>
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
