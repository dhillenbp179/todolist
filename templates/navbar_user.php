<?php
require_once "header.php";

$cekIdUser = $_SESSION['id_user'];
$query = "SELECT * FROM workspace WHERE id_user = $cekIdUser";
$workspace = mysqli_query($link, $query);
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-purple navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index?page=beranda" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index?page=view_workspace" class="nav-link">Workspace</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <!-- <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Cari Workspace" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li> -->
        <!-- User Account -->
        <li class="nav-item dropdown">
            <a href="#" class="bg-purple dropdown-item" data-toggle="dropdown">
                <div class="image user-panel">
                    <img src="../assets/img/user_profile/<?= $_SESSION['foto_profil']; ?>" alt="User Avatar" class="img-size-20 img-bordered-sm img-circle">
                    <div class="image">
                        <h3 class="dropdown-item-title username text-light">
                            <?= $_SESSION['name']; ?>
                        </h3>
                    </div>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-center">
                <div href="#" class="dropdown-item">
                    <!-- Profil Start -->
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="../assets/dist/img/new-user.png" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $_SESSION['name']; ?></h3>

                        <p class="text-info text-center">@<?= $_SESSION['username']; ?></p>
                    </div>
                    <!-- Profil End -->
                </div>
                <div class="dropdown-divider"></div>
                <a href="index?page=profile" class="btn btn-primary btn-block mb-3"><b> Lihat Detail Profil <i class="fas fa-eye m-1"></i></b></a>
                <a href="../auth/logout" class="btn btn-danger btn-block"><b> Logout <i class="fas fa-sign-out-alt ml-1"></i></b></a>
            </div>
        </li>
        <!-- END Profil Dropdown Menu -->
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index" class="brand-link">
        <img src="../assets/dist/img/logo_dabta.png" alt="Dabta Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dabta | To Do List</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <div class="form-inline mt-3 pb-3 d-flex">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Cari Workspace" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            My Workspace
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <?php foreach ($workspace as $data) : ?>
                            <li class="nav-item">
                                <a href="index?page=detail_workspace&id=<?= $data['id_goal']; ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p><?= $data['nm_goal']; ?></p>

                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>