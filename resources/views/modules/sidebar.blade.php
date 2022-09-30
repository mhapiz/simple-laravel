<div class="sidebar">
    <div class="logo-details">
        <i class='bx bxl-visual-studio'></i>
        <span class="logo_name">Admin</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin') ? 'active' : '' }}">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.kamar.index') }}" class="{{ request()->is('admin/kamar*') ? 'active' : '' }}">
                <i class='bx bxs-hotel'></i>
                <span class="links_name">Kamar</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.sewa-kamar.index') }}"
                class="{{ request()->is('admin/sewa-kamar*') ? 'active' : '' }}">
                <i class='bx bx-transfer-alt'></i>
                <span class="links_name">Sewa Kamar</span>
            </a>
        </li>
        <li class="log_out">
            <a href="{{ route('logout') }}">
                <i class='bx bx-log-out'></i>
                <span class="links_name">Log out</span>
            </a>
        </li>
    </ul>
</div>
