<ul id="sidebarnav">
    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">Home</span>
    </li>

    <!-- Dashboard -->
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin')) active @endif" href="{{ url('/admin') }}">
            <span><i class="ti ti-layout-dashboard"></i></span>
            <span class="hide-menu">Dashboard</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">keuangan</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pemasukan*')) active @endif" href="{{ url('/admin/pemasukan') }}">
            <span><i class="ti ti-cash"></i></span>
            <span class="hide-menu">Pemasukan</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pengeluaran*')) active @endif" href="{{ url('/admin/pengeluaran') }}">
            <span><i class="ti ti-cash"></i></span>
            <span class="hide-menu">Pengeluaran</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">data</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/alumni*')) active @endif" href="{{ url('/admin/alumni') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Alumni</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">data</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/agenda*')) active @endif" href="{{ url('/admin/agenda') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Agenda</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">master</span>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/master/alumni*')) active @endif"
            href="{{ url('/admin/master/alumni') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Alumni Master</span>
        </a>
    </li>

    <li class="sidebar-item">
        <a class="sidebar-link @if (Request::is('admin/pengguna*')) active @endif" href="{{ url('/admin/pengguna') }}">
            <span><i class="ti ti-users"></i></span>
            <span class="hide-menu">Pengguna</span>
        </a>
    </li>

    <li class="nav-small-cap">
        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
        <span class="hide-menu">lainnya</span>
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
