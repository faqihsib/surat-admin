{{-- start sidebar --}}
<div id="sidebar" class='active'>
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class='sidebar-title'>Main Menu</li>
                        <li class="sidebar-item">
                            <a href="{{ route('admin.index') }}" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class='sidebar-title'>Fitur Utama</li>
                        <li class="sidebar-item">
                            <a href="{{ route('jenis-surat.index') }}" class='sidebar-link'>
                                <i data-feather="file-text" width="20"></i>
                                <span>Jenis Surat</span>
                            </a>
                        </li>
                        <li class='sidebar-title'>Master Data</li>
                        <li class="sidebar-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                            <a href="{{ route('warga.index') }}" class='sidebar-link'>
                                <i data-feather="users" width="20"></i>
                                <span>Data Warga</span>
                            </a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}" class='sidebar-link'>
                                <i data-feather="user" width="20"></i>
                                <span>Data User</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <form method="POST" action="{{ route('auth.logout') }}" id="logout-form" class="d-none">
                                @csrf
                            </form>
                            <a href="#" class='sidebar-link'
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i data-feather="log-out" width="20"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
{{-- end sidebar --}}
