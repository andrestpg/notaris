<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?> - Dhani Notaris PPAT</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/templates/dist/css/adminx.css') ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/loader.css') ?>" media="screen" />
    <link rel="shortcut icon" href="<?= base_url('assets/templates/demo/img/icon.ico') ?>" type="image/x-icon">
    <script>
        const baseUrl = '<?= base_url() ?>';
        const aAks = <?= $admin['akses']; ?>;
    </script>
    <style>
        .dataTables_wrapper .col-md-5, .dataTables_wrapper .col-md-6, .dataTables_wrapper .col-md-7{
            padding-left: 0;
            padding-right: 0;
        }
    </style>
</head>
<body>
    <div class="adminx-container">
        <nav class="navbar navbar-expand justify-content-between fixed-top">
            <a class="navbar-brand mb-0 h1 d-none d-md-block" href="<?= base_url() ?>">
                <img src="<?= base_url('/assets/templates/demo/img/logo.png') ?>" class="navbar-brand-image d-inline-block align-top mr-2" alt=""/>
                <?= ucfirst($admin['nama']) ?>
            </a>

            <div class="d-flex flex-1 d-block d-md-none">
                <a href="#" class="sidebar-toggle ml-3">
                    <i data-feather="menu"></i>
                </a>
            </div>

            <ul class="navbar-nav d-flex justify-content-end mr-2">
                <li class="nav-item dropdown">
                    <a class="nav-link avatar-with-name" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                        <!-- <h5 class="d-inline mr-2 text-dark name-mobile"><?= ucfirst($admin['nama']) ?></h5> -->
                        <img src="<?= base_url('assets/img/').$admin['foto'] ?>" class="d-inline-block align-top" alt="">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-1" aria-labelledby="navbarDropdownMenuLink">
                        <p class="font-weight-bold text-center mb-0 admin-name"><?= ucfirst($admin['nama']) ?></p>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('user/edit_profil/').$admin['id'] ?>">Edit Profil</a>
                        <a class="dropdown-item text-danger" href="<?= base_url('login/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <?php $uri1 = $this->uri->segment(1); ?>
        <?php $uri2 = $this->uri->segment(2); ?>
        <!-- expand-hover push -->
        <!-- Sidebar -->
        <div class="adminx-sidebar expand-hover push">
            <ul class="sidebar-nav">
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('home') ?>" class="sidebar-nav-link <?php if ($uri1 == 'home') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="home"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Beranda
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
                
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('user') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'user') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="user-check"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            User
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a href="<?= base_url('pengorder') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'pengorder') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Pengorder
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>

                <li class="sidebar-nav-item">
                    <a href="<?= base_url('klien') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'klien') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="users"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Klien
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
                
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('akta') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'akta') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="edit"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Akta
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
                
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('ppat') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'ppat') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="repeat"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            PPAT
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
                
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('berkas') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'berkas') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="file-text"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Berkas Masuk PPAT
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
                
                <li class="sidebar-nav-item">
                    <a href="<?= base_url('rekap') ?>" class="sidebar-nav-link  <?php if ($uri1 == 'rekap') {
                                                                                    echo 'active';
                                                                                } ?>">
                        <span class="sidebar-nav-icon">
                            <i data-feather="layers"></i>
                        </span>
                        <span class="sidebar-nav-name">
                            Rekap Data Sertifikat
                        </span>
                        <span class="sidebar-nav-end">
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="adminx-content"> 
            <div class="adminx-main-content px-1">
                <div class="container-fluid">
                    <!-- BreadCrumb -->
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb adminx-page-breadcrumb">
                            <li class="breadcrumb-item <?php if($uri1 == 'home'){echo 'active';} ?>"><?php if($uri1 == 'home'){echo 'Home';}else{echo '<a href="'.base_url('home') .'">Home</a>';} ?></li>
                            <?php if($uri1 != 'home' ): ?>
                                <?php if($uri2 == 'add' || $uri2 == 'edit'): ?>
                                    <?php if($uri1 == 'berkas'): ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url($uri1) ?>">Berkas Masuk PPAT</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                    <?php elseif($uri1 == 'rekap'): ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url($uri1) ?>">Rekap Data Sertifikat</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                    <?php else: ?>
                                    <li class="breadcrumb-item"><a href="<?= base_url($uri1) ?>"><?= ucfirst($uri1) ?></a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ol>
                    </nav>
                    <!-- BreadCrumb -->