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
