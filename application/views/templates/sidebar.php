        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('beranda') ?>">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('beranda') ?>">
                    <i class="fas fa-fw fa-landmark"></i>
                    <span>Beranda</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hotspot"
                    aria-expanded="true" aria-controls="hotspot">
                    <i class="fas fa-fw fa-user"></i>
                    <span>User</span>
                </a>
                <div id="hotspot" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-dark py-2 collapse-inner rounded">
                        <a class="collapse-item " href="<?= base_url('mahasiswa') ?>"><i class="fas fa-users"></i><span> Mahasiswa</span></a>
                        <a class="collapse-item" href="<?= base_url('staf') ?>"><i class="fas fa-user"></i><span> Staff</span></a>
                        <a class="collapse-item" href="<?= base_url('daftar_user') ?>"><i class="fas fa-list"></i><span> Daftar User Aktif</span></a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

