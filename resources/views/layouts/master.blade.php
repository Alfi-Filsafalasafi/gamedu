<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>GamEdu - @yield('title')</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    @include('layouts.scripts.css')
</head>

<body>
    <!-- ======= Header ======= -->
    @include('layouts.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">
            @if (auth()->user()->role == 'admin')
                @include('layouts.sidebar.admin')
            @elseif (auth()->user()->role == 'mahasiswa')
                @include('layouts.sidebar.mahasiswa')
            @elseif(auth()->user()->role == 'dosen')
                @include('layouts.sidebar.dosen')
            @endif

        </ul>
    </aside>
    <!-- End Sidebar-->

    <main id="main" class="main">
        @yield('content')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('layouts.footer')
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    @include('layouts.scripts.js')
    @yield('scripts')
</body>

</html>
