<?php $uri = $this->uri->segment(1); $uri1 = $this->uri->segment(2) ?>
<div class="nav-left-sidebar sidebar-dark">
<div class="menu-list">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-column">
                <li class="nav-divider">
                    Menu
                </li>

                <li class="nav-item">
                    <a href="<?php echo site_url('') ?>" class="nav-link <?php echo $uri == '' | $uri === 'dashboard' ? 'active' : '' ?>"><i class="fa fa-fw fa-chart-area"></i>Dashboard</a>
                </li>

                <?php if($this->session->userdata('role') == "Admin"){ ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url('transaksi/history') ?>" class="nav-link "><i class="fa fa-fw fa-money-bill-alt"></i>History Transaksi</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('transaksi/gagal') ?>" class="nav-link "><i class="fa fa-fw fa-money-bill-alt"></i>Transaksi Gagal</a>
                    </li>
                <?php }else{ ?>
                    <li class="nav-item">
                        <a href="<?php echo site_url('transaksi') ?>" class="nav-link <?php echo $uri === 'transaksi' ? 'active' : '' ?>"><i class="fa fa-fw fa-money-bill-alt"></i>Transaksi</a>
                    </li>
                <?php } ?>
                <!-- <li class="nav-item">
                    <a href="<?php echo site_url('transaksi/history') ?>" class="nav-link <?php echo $uri === 'transaksi/history' ? 'active' : '' ?>"><i class="fa fa-fw fa-clock"></i>History Transaksi</a>
                </li> -->

                <?php if($this->session->userdata('role') == "Admin"){ ?>
                <li class="nav-item">
                        <a href="#" class="nav-link <?php echo $uri === 'order' ? 'active' : '' ?>" data-toggle="collapse" aria-expanded="false" data-target="#data-order" aria-controls="#data-order"><i class="fa fa-fw fa-ticket-alt"></i>Order</a>
                        <div id="data-order" class="collapse submenu <?php echo $uri === 'order' ? 'show' : '' ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('order/masakan') ?>" class="nav-link <?php echo $uri1 === 'masakan' ? 'active' : '' ?>">Order Masakan</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('order/meja') ?>" class="nav-link <?php echo $uri1 === 'meja' ? 'active' : '' ?>">Order Meja</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Admin -->
                    
                    <li class="nav-divider">
                        Master
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link <?php echo $uri === 'kategori_masakan' | $uri === 'masakan' ? 'active' : '' ?>" data-toggle="collapse" aria-expanded="false" data-target="#data-menu" aria-controls="#data-menu"><i class="fa fa-fw fa-book"></i>Masakan</a>
                        <div id="data-menu" class="collapse submenu <?php echo $uri === 'kategori_masakan' | $uri === 'masakan' ? 'show' : '' ?>">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo site_url('kategori_masakan') ?>" class="nav-link <?php echo $uri === 'kategori_masakan' ? 'active' : '' ?>">Kategori</a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo site_url('masakan') ?>" class="nav-link <?php echo $uri === 'masakan' ? 'active' : '' ?>">Data Masakan</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('meja') ?>" class="nav-link <?php echo $uri === 'meja' ? 'active' : '' ?>"><i class="fa fa-fw fa-table"></i>Meja</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('pengguna') ?>" class="nav-link <?php echo $uri === 'pengguna' ? 'active' : '' ?>"><i class="fa fa-fw fa-user"></i>Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo site_url('pengaturan') ?>" class="nav-link <?php echo $uri === 'pengaturan' ? 'active' : '' ?>"><i class="fa fa-fw fa-cog"></i>Pengaturan</a>
                    </li>
                <?php } ?>
                
            </ul>
        </div>
    </nav>
</div>
</div>