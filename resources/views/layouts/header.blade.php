<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('welcome') }}" class="logo d-flex align-items-center">
            <img src="{{ asset('NiceAdmin/assets/img/logo.png') }}" alt="" />
            <span class="d-none d-lg-block">{{ env('APP_NAME', 'Laravel') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            @if (auth()->user()->role == 'dosen')
                <li class="nav-item dropdown me-4 d-flex align-items-center">
                    <span>Token anda : {{ auth()->user()->token_dosen }}</span>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    @if (auth()->user()->role == 'mahasiswa')
                        @if (isset($jumlahRevisi) && $jumlahRevisi > 0)
                            <span class="badge bg-warning badge-number">{{ $jumlahRevisi }}</span>
                        @endif
                    @elseif (auth()->user()->role == 'dosen')
                        @if (isset($jumlahTugas) && $jumlahTugas > 0)
                            <span class="badge bg-primary badge-number">{{ $jumlahTugas }}</span>
                        @endif
                    @endif
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        @if (auth()->user()->role == 'mahasiswa')
                            @if (isset($jumlahRevisi) && $jumlahRevisi > 0)
                                Kamu memiliki {{ $jumlahRevisi }} tugas yang harus di revisi
                                <a href="{{ route('mahasiswa.bab.index') }}">
                                    <span class="badge rounded-pill bg-primary p-2 ms-2">
                                        View all
                                    </span>
                                </a>
                            @else
                                Tidak ada notifikasi
                            @endif
                        @elseif (auth()->user()->role == 'dosen')
                            @if (isset($jumlahTugas) && $jumlahTugas > 0)
                                Anda memiliki {{ $jumlahTugas }} tugas yang harus di proses
                                <a href="{{ route('dosen.tugas.bab') }}">
                                    <span class="badge rounded-pill bg-primary p-2 ms-2">
                                        View all
                                    </span>
                                </a>
                            @else
                                Tidak ada notifikasi
                            @endif
                        @endif

                    </li>
                </ul>
                <!-- End Notification Dropdown Items -->
            </li>

            @if (auth()->user()->role == 'mahasiswa')
                <li class="nav-item dropdown me-4 d-flex align-items-center">
                    <i class="ri-money-dollar-box-fill text-success me-2" style="font-size: 24px"></i>
                    <span>{{ auth()->user()->uang ?? 0 }}</span>
                </li>
            @endif
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->photo ? asset(auth()->user()->photo) : asset('assets/img/profile/not-profile-photo.png') }}"
                        alt="Profile" class="rounded-circle" />
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                        <span>{{ auth()->user()->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('profile.index') }}">
                            <i class="bi bi-person"></i>
                            <span>Profil Saya</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->
        </ul>
    </nav>
    <!-- End Icons Navigation -->
</header>
