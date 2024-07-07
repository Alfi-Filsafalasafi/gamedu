@extends('layouts.master')
@section('title', 'Home Mahasiswa')
@section('dashboard', 'nav-link collapsed')
@section('materi', 'nav-link collapsed')
@section('games', 'nav-link ')
@section('peringkat', 'nav-link collapsed')
@section('content')


    <section class="section dashboard">
        <div class="card">
            <h5 class="card-title text-center">Fitur dalam pengembangan</h5>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <img src="{{ asset('assets/img/develop.jpg') }}" class="w-100" alt="">
                </div>
            </div>
            <p class="mx-4 text-center mb-4">Jangan khawatir, ketika fitur sudah siap, akan diberitahukan secepatnya</p>
        </div>
    </section>
@endsection
