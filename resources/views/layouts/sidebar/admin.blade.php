<li class="nav-item">
    <a class="@yield('dashboard')" href="{{ route('admin.index') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
    </a>
</li>
<!-- End Dashboard Nav -->




<li class="nav-heading">Manajemen</li>

<li class="nav-item">
    <a class="@yield('user')" href="{{ route('admin.user.index') }}">
        <i class="bi bi-person"></i>
        <span>User</span>
    </a>
</li>
<li class="nav-item">
    <a class="@yield('berita')" href="{{ route('admin.berita.index') }}">
        <i class="bi bi-newspaper"></i>
        <span>Berita</span>
    </a>
</li>
<li class="nav-item">
    <a class="@yield('info')" href="{{ route('admin.info.index') }}">
        <i class="bi bi-file-earmark-image"></i>
        <span>Informasi</span>
    </a>
</li>
