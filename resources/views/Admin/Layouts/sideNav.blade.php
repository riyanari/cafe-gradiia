<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Admin MyU</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#myULayouts" aria-expanded="false" aria-controls="myULayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                    Admin CafeMyU
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="myULayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="">Penambahan Cafe</a>
                        <a class="nav-link" href="">Laporan Keungan</a>
                        <!-- <a class="nav-link" href="layout-sidenav-light.html">Tata usaha</a> -->
                    </nav>
                </div>

                <div class="sb-sidenav-menu-heading">Owner Cafe</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                    Owner Cafe
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="">Laporan Keungan</a>
                        <a class="nav-link" href="">Laporan Penjualan</a>
                        <a class="nav-link" href="">Pengiriman ke MyU</a>
                        <!-- <a class="nav-link" href="layout-sidenav-light.html">Tata usaha</a> -->
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Cashier</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#CashierLayouts" aria-expanded="false" aria-controls="CashierLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                    Cashier Cafe
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="CashierLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="">Terima Pesanan</a>
                        <a class="nav-link" href="">Manajemen Menu</a>
                        <a class="nav-link" href="">Manajemen Meja</a>
                        <!-- <a class="nav-link" href="layout-sidenav-light.html">Tata usaha</a> -->
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Others</div>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-calendar"></i></div>
                    Tahun Ajaran
                </a>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                    Mata Pelajaran
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{ Auth::user()->name }}</div>
            {{-- {{ Auth::user()->name }} --}}
            {{-- {{ Auth::user()->role }} -> {{ Auth::user()->name }} --}}
        </div>
    </nav>
</div>