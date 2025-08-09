<ul id="sidebarnav">
    {{-- Home --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/operator')) active @endif" href="{{ url('admin/operator') }}">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>

    {{-- Keuangan --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Keuangan</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/saldo*')) active @endif" href="{{ url('/admin/saldo') }}">
            <span><i class="ti ti-wallet"></i></span> {{-- Ikon dompet --}}
            <span class="hide-menu">Saldo</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pemasukan*')) active @endif" href="{{ url('/admin/pemasukan') }}">
            <span><i class="ti ti-arrow-down-circle"></i></span> {{-- Ikon panah masuk --}}
            <span class="hide-menu">Pemasukan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pengeluaran*')) active @endif" href="{{ url('/admin/pengeluaran') }}">
            <span><i class="ti ti-arrow-up-circle"></i></span> {{-- Ikon panah keluar --}}
            <span class="hide-menu">Pengeluaran</span>
        </a>
    </li>

    {{-- Alumni --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Alumni</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/alumni*')) active @endif" href="{{ url('/admin/alumni') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Alumni</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/master/alumni*')) active @endif"
            href="{{ url('/admin/master/alumni') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Alumni Master</span>
        </a>
    </li>

    {{-- Agenda & Berita --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Agenda & Berita</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/agenda*')) active @endif" href="{{ url('/admin/agenda') }}">
            <span><i class="ti ti-calendar"></i></span>
            <span class="hide-menu">Agenda</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/berita*')) active @endif" href="{{ url('/admin/berita') }}">
            <span><i class="ti ti-news"></i></span>
            <span class="hide-menu">Berita</span>
        </a>
    </li>

    {{-- Media --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Media</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/galeri*')) active @endif" href="{{ url('/admin/galeri') }}">
            <span><i class="ti ti-photo"></i></span>
            <span class="hide-menu">Galeri</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/campaign*')) active @endif" href="{{ url('/admin/campaign') }}">
            <span><i class="ti ti-flag"></i></span>
            <span class="hide-menu">Campaign</span>
        </a>
    </li>

    {{-- Pengguna --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Pengguna</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pengguna*')) active @endif" href="{{ url('/admin/pengguna') }}">
            <span><i class="ti ti-user"></i></span>
            <span class="hide-menu">Pengguna</span>
        </a>
    </li>

    {{-- Logout --}}
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Keluar</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <span><i class="ti ti-logout"></i></span>
            <span class="hide-menu">Logout</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
