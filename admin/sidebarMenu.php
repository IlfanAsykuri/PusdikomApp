<?php
$url = "/phpdasar/PusdikomApp/admin/sidebarMenu.php";
if($_SERVER["REQUEST_URI"] == $url ){
  header("Location: index.php");
  exit;
}

$keyword = $_SESSION["login"];
$dataAdmin = loadData("SELECT * FROM tb_admin WHERE id_admin = '$keyword'")[0];


?>
<!-- Brand Logo -->
<a href="index3.html" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: 0.8" />
    <span class="brand-text font-weight-light">PusdikomApp</span>
</a>

<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="../dist/img/<?= $dataAdmin["foto"] ?>" class="img-circle elevation-2" alt="User Image"
                style="width: 35px; height: 35px;" />
        </div>
        <div class="info">
            <a href="#" class="d-block"><?= $dataAdmin["nama"] ?></a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="index.php" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="datasantri.php" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Data Santri
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="dataKamarDevisi.php" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Data Kamar & Devisi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="historyTransaksi.php" class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>
                        History Transaksi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="dataAdmin.php" class="nav-link">
                    <i class="nav-icon fa-solid fa-lock"></i>
                    <p>
                        Data Admin
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

<!-- /.sidebar -->