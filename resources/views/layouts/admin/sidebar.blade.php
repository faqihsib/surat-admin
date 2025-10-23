{{-- start sidebar --}}
<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>

                <li class="sidebar-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <a href="{{ route('warga.index') }}" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Data Warga</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('jenis-surat.*') ? 'active' : '' }}">
                    <a href="{{ route('jenis-surat.index') }}" class='sidebar-link'>
                        <i data-feather="file-text" width="20"></i>
                        <span>Jenis Surat</span>
                    </a>
                </li>

                {{-- Logout --}}
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('auth.logout') }}" id="logout-form" class="d-none">
                        @csrf
                    </form>
                    <a href="#" class='sidebar-link' onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i data-feather="log-out" width="20"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
{{-- end sidebar --}}
