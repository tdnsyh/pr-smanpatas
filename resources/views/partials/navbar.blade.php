<div class="sticky-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">IKA SMANPATAS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button">
                            Profil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="profilDropdown">
                            <li><a class="dropdown-item" href="/profil">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="/alumni">Data Alumni</a></li>
                            <li><a class="dropdown-item" href="/agenda">Agenda</a></li>
                        </ul>
                    </li>

                    <!-- Dropdown Informasi -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="infoDropdown" role="button">
                            Informasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                            <li><a class="dropdown-item" href="/berita">Berita</a></li>
                            <li><a class="dropdown-item" href="/campaign">Campaign</a></li>
                            <li><a class="dropdown-item" href="/galeri">Galeri</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Tombol Masuk -->
                <span class="navbar-text ms-3">
                    @auth
                        @php
                            // Cek role user dan tentukan route dashboard
                            switch (auth()->user()->role) {
                                case 'operator':
                                    $dashboardRoute = route('operator.dashboard.index');
                                    break;
                                case 'media':
                                    $dashboardRoute = route('media.dashboard.index');
                                    break;
                                case 'sekretaris':
                                    $dashboardRoute = route('sekretaris.dashboard.index');
                                    break;
                                case 'bendahara':
                                    $dashboardRoute = route('bendahara.dashboard.index');
                                    break;
                                case 'alumni':
                                    $dashboardRoute = route('alumni.dashboard.index');
                                    break;
                                default:
                                    $dashboardRoute = '#'; // fallback
                            }
                        @endphp

                        <a href="{{ $dashboardRoute }}" class="btn btn-light rounded text-primary">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light rounded text-primary">
                            Masuk
                        </a>
                    @endauth
                </span>
            </div>
        </div>
    </nav>
</div>

<!-- CSS Hover Dropdown & Warna Teks -->
<style>
    @media (min-width: 992px) {
        .navbar .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
        }
    }

    /* Tetap putih saat hover di navbar-dark */
    .navbar-dark .navbar-nav .nav-link:hover,
    .navbar-dark .navbar-nav .nav-link:focus {
        color: #fff;
    }
</style>
