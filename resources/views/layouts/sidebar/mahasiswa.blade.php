<li class="nav-item">
    <a class="@yield('dashboard')" href="{{ route('mahasiswa.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<!-- End Dashboard Nav -->




<li class="nav-heading">Pages</li>

<li class="nav-item">
    <a class="@yield('materi')" href="{{ route('mahasiswa.bab.index') }}">
        <i class="bi bi-book"></i>
        <span>Materi</span>
    </a>
</li>
