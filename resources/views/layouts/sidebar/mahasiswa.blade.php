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

<li class="nav-heading">Bonus</li>

<li class="nav-item">
    <a class="@yield('games')" href="{{ route('mahasiswa.games.index') }}">
        <i class="bi bi-joystick"></i>
        <span>Games</span>
    </a>
</li>

<li class="nav-heading">Pendukung</li>

<li class="nav-item">
    <a class="@yield('peringkat')" href="{{ route('mahasiswa.peringkat.index') }}">
        <i class="bi bi-trophy"></i>
        <span>Peringkat</span>
    </a>
</li>
