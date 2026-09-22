<nav id="sidebar">
    <div class="brand d-flex align-items-center">
        <i class="fas fa-truck-moving me-2" style="color: #6366f1;"></i>
        <span>Patra Logistik</span>
    </div>
    
    <div class="nav flex-column mt-3">
        <!-- Menu text divider -->
        <small class="text-muted px-4 mb-2 fw-semibold" style="font-size: 11px; letter-spacing: 1px;">MENU UTAMA</small>
        
        <a class="nav-link {{ request()->routeIs('bank-data.index') ? 'active' : '' }}" href="{{ route('bank-data.index') }}">
            <i class="fas fa-database"></i> Bank Data
        </a>

        <a class="nav-link {{ request()->routeIs('afkir.index') ? 'active' : '' }}" href="{{ route('afkir.index') }}">
            <i class="fas fa-file-signature"></i> MT Afkir & Dispen
        </a>

        <a class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
            <i class="fas fa-chart-pie"></i> Kategori MT
        </a>
        <a class="nav-link {{ request()->routeIs('transportir.index') ? 'active' : '' }}" href="{{ route('transportir.index') }}">
            <i class="fas fa-building"></i> List Transportir
        </a>
        <!-- Menu text divider -->
        <small class="text-muted px-4 mt-4 mb-2 fw-semibold" style="font-size: 11px; letter-spacing: 1px;">PENGATURAN</small>

        <a class="nav-link text-danger mt-auto" href="{{ route('logout') }}">
            <i class="fas fa-sign-out-alt text-danger"></i> Logout
        </a>
    </div>
</nav>