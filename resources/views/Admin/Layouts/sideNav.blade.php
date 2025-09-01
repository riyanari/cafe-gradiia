<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <div class="sb-sidenav-menu-heading">Users</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-person"></i></div>
                    Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="">Siswa</a>
                        <a class="nav-link" href="">Alumni</a>
                        <a class="nav-link" href="">Guru</a>
                        <!-- <a class="nav-link" href="layout-sidenav-light.html">Tata usaha</a> -->
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Pages</div>
                <a class="nav-link" href="">
                    <div class="sb-nav-link-icon"><i class="fa-regular fa-newspaper"></i></div>
                    Pengumuman
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>
                    School page
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Akademik
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav" id="sidenavAccordionPagesHafalan">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseHafalan" aria-expanded="false" aria-controls="pagesCollapseHafalan">
                                    Hafalan
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseHafalan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPagesHafalan">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="">Hafalan KDU</a>
                                        <a class="nav-link" href="">Hafalan Sorof</a>
                                        <a class="nav-link" href="">Hafalan Siswa</a>
                                    </nav>
                                </div>
                                <a class="nav-link" href="">Jadwal Pelajaran</a>
                                <a class="nav-link" href="">Kehadiran Siswa</a>
                                <a class="nav-link" href="">Prestasi</a>
                                <a class="nav-link" href="#">Nilai <span class="text-muted">(dev)</span></a>
                            </nav>
                        </div>
                        {{-- @if(Auth::user()->nisn === 'bendaharadafa') --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAdministrasi" aria-expanded="false" aria-controls="pagesCollapseAdministrasi">
                            Administrasi
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAdministrasi" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPagesAdministrasi">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Administrasi</a>
                                <a class="nav-link" href="">Administrasi Siswa</a>
                            </nav>
                        </div>
                        {{-- @endif --}}
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapsePelanggaran" aria-expanded="false" aria-controls="pagesCollapsePelanggaran">
                            Pelanggaran
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapsePelanggaran" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPagesPelanggaran">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="">Jenis Pelanggaran</a>
                                <a class="nav-link" href="">Pelanggaran Siswa</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="ekstrakulikuler">
                            Ekstrakulikuler
                        </a>

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
            <div class="small">Logged in as:</div>
            {{-- {{ Auth::user()->name }} --}}
            {{-- {{ Auth::user()->role }} -> {{ Auth::user()->name }} --}}
        </div>
    </nav>
</div>