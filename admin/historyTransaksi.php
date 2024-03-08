<?php

session_start();

if(!$_SESSION["login"]){
  header("Location: ../login.php");
  exit;
}

require "functions.php";

$allDataPeminjaman = loadData("SELECT * FROM tb_peminjaman AS p JOIN tb_santri AS s JOIN tb_kamar AS k JOIN tb_devisi AS d ON p.niup = s.niup AND s.kode_kamar = k.kode_kamar AND k.kode_devisi = d.kode_devisi WHERE p.waktu_kembali IS NOT NULL");

if(isset($_POST["cari"])){
  $keyword = $_POST["keyword"];
  $allDataPeminjaman = loadData("SELECT * FROM tb_peminjaman AS p JOIN tb_santri AS s JOIN tb_kamar AS k JOIN tb_devisi AS d ON p.niup = s.niup AND s.kode_kamar = k.kode_kamar AND k.kode_devisi = d.kode_devisi WHERE (s.niup LIKE '%$keyword%' OR s.nama LIKE '%$keyword%') AND p.waktu_kembali IS NOT NULL");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css" />
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css" />
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css" />
    <!-- font Awesome -->
    <script src="https://kit.fontawesome.com/1f8a12df3e.js" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <!-- <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div> -->

        <!-- Navbar -->
        <?php include "navbarView.php" ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include "sidebarMenu.php" ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">History Transaksi</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">Data Santri</li>
                            </ol>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12 connectedSortable">
                            <div class="card">
                                <div class="card-header">
                                    <a href="http://" class="btn btn-sm btn-success"><i
                                            class="fa-solid fa-file-export"></i> Export Data</a>

                                    <div class="card-tools">
                                        <form action="" method="post">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="keyword" class="form-control"
                                                    placeholder="Search">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default" name="cari">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap text-center">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NIUP</th>
                                                <th>NAMA</th>
                                                <th>JENIS KELAMIN</th>
                                                <th>KAMAR</th>
                                                <th>DEVISI</th>
                                                <th>MERK LAPTOP</th>
                                                <th>STATUS PENGEMBALIAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach($allDataPeminjaman as $peminjaman) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $peminjaman["niup"]; ?></td>
                                                <td><?= $peminjaman["nama"]; ?></td>
                                                <?php if($peminjaman["jk"] == "l" ){  ?>
                                                <td>Laki-laki</td>
                                                <?php }else{ ?>
                                                <td>Perempuan</td>
                                                <?php } ?>
                                                <td><?= $peminjaman["kamar"]; ?></td>
                                                <td><?= $peminjaman["devisi"]; ?></td>
                                                <td><?= $peminjaman["merk_laptop"]; ?></td>
                                                <?php if($peminjaman["status_peminjaman"] == 1){ ?>
                                                <td><small class="badge badge-danger">Telat</small>
                                                </td>
                                                <?php }else{ ?>
                                                <td><small class="badge badge-success">Tepat Waktu</small></td>
                                                <?php } ?>
                                                <td>
                                                    <a href="detailHistoryTraksaksi.php?kode_peminjaman=<?= $peminjaman["kode_peminjaman"] ?>"
                                                        class="btn btn-sm btn-info"><i
                                                            class="fa-solid fa-circle-info"></i></a>
                                                    <a href="hapusHistoryTransaksi.php?kode_peminjaman=<?= $peminjaman["kode_peminjaman"] ?>"
                                                        class="btn btn-sm btn-danger"><i
                                                            class="fa-solid fa-trash-can"></i></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer clearfix">
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.card -->
                        </section>
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021
                <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="../plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../dist/js/pages/dashboard.js"></script>
</body>



</html>