<ul id="sidebarnav">
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
    </li>

    <!-- Dashboard -->
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('kehormatan/dashboard')) active @endif" href="{{ url('kehormatan/dashboard') }}">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">keuangan</span>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('kehormatan/donasi')) active @endif" href="{{ url('kehormatan/donasi') }}">
            <span><i class="ti ti-arrow-up-circle"></i></span>
            <span class="hide-menu">Riwayat Donasi</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">lainnya</span>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('kehormatan/profil')) active @endif" href="{{ url('kehormatan/profil') }}">
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
