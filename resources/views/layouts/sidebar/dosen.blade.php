<li class="nav-item">
    <a class="@yield('dashboard')" href="{{ route('dosen.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<!-- End Dashboard Nav -->

<!-- End Components Nav -->



<li class="nav-heading">Manajemen</li>

<li class="nav-item">
    <a class="@yield('materi')" href="{{ route('dosen.bab.index') }}">
        <i class="bi bi-book"></i>
        <span>Materi</span>
    </a>
</li>
<li class="nav-item">
    <a class="@yield('kuis')" href="{{ route('dosen.quiz.index') }}">
        <i class="bi bi-award"></i>
        <span>Kuis</span>
    </a>
</li>

<li class="nav-heading">Tugas Materi</li>
<li class="nav-item">
    <a class="@yield('tugas')" href="{{ route('dosen.tugas.bab') }}">
        <i class="bi bi-clipboard"></i>
        <span>Tugas</span>
        @if (isset($jumlahTugas) && $jumlahTugas > 0)
            <span class=" ms-1 badge bg-primary">{{ $jumlahTugas }}</span>
        @endif

    </a>
</li>
<li class="nav-heading">Pendukung</li>
<li class="nav-item">
    <a class="@yield('peringkat')" href="{{ route('dosen.peringkat.index') }}">
        <i class="bi bi-trophy"></i>
        <span>Peringkat</span>

    </a>
</li>
