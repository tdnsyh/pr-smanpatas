<ul id="sidebarnav">
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
    </li>

    <!-- Dashboard -->
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/media')) active @endif" href="{{ url('/admin/media') }}">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">konten</span>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/galeri*')) active @endif" href="{{ url('/admin/galeri') }}">
            <span><i class="ti ti-photo"></i></span>
            <span class="hide-menu">Galeri</span>
        </a>
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

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">lainnya</span>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/profil')) active @endif" href="{{ url('admin/profil') }}">
            <span><i class="ti ti-user"></i></span>
            <span class="hide-menu">Profil</span>
        </a>
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
