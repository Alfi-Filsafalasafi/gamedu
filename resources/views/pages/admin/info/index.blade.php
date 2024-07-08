@extends('layouts.master')
@section('title', 'Manajemen Akun')
@section('dashboard', 'nav-link collapsed')
@section('user', 'nav-link collapsed')
@section('berita', 'nav-link collapsed')
@section('info', 'nav-link')

@section('content')

    <div class="pagetitle">
        <h1>Manajemen Informasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                <li class="breadcrumb-item active">Manajemen Informasi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    @include('layouts.partials.alert')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-1">Manajemen Informasi</h5>
                        <p class="">Anda dapat melakukan penambahan, perubahan, dan penghapusan informasi yang ada di
                            landing
                            page</p>
                        <a href="{{ route('admin.info.create') }}" class="btn btn-success btn-sm">Tambah</a>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table datatable" style="font-size: 0.9em">
                                <thead>
                                    <tr>
                                        <th width="10%"><i class="bx bx-cog"></i></th>
                                        <th>Img</th>
                                        <th>Judul</th>
                                        <th>Pembuat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>

                                                <a href="{{ route('admin.info.edit', ['id' => $data->id]) }}"
                                                    class="btn btn-warning btn-sm"><i class="bx bxs-edit"></i></a>
                                                <a href="{{ route('admin.info.delete', ['id' => $data->id]) }}"
                                                    class="btn btn-danger btn-sm" data-confirm-delete="true">
                                                    <i class="bx bxs-trash"></i>
                                                </a>
                                                </form>
                                            </td>
                                            <td>
                                                @if ($data->photo)
                                                    <img src="{{ asset($data->photo) }}" alt=""
                                                        style="max-width: 84px">
                                                @else
                                                    <img src="{{ asset('assets/img/profile/not-profile-photo.png') }}"
                                                        alt="" style="width: 84px">
                                                @endif
                                            </td>
                                            <td>{{ $data->judul }}</td>
                                            <td>{{ $data->admin->name }}</td>
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