<?php
session_start();

if(!$_SESSION["login"]){
  header("Location: ../login.php");
  exit;
}

require "functions.php";

if(isset($_GET["niup"])){
  $niup = $_GET["niup"];

  // load data by niup
  $loadDataByNIUP = loadData("SELECT * FROM tb_santri AS s JOIN tb_kamar AS k JOIN tb_devisi AS d ON s.kode_kamar = k.kode_kamar AND k.kode_devisi = d.kode_devisi WHERE niup = '$niup'")[0];


  $checkedLk = "";
  $checkedPR  = "";
  if($loadDataByNIUP["jk"] == "l"){
    $checkedLk = "checked";
  }else{
    $checkedPR = "checked";
  }


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
                            <h1 class="m-0">Tambah Data Santri</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="datasantri.php">Data Santri</a></li>
                                <li class="breadcrumb-item active">Tambah Data Santri</li>
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
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-8 offset-md-2">
                            <!-- jquery validation -->
                            <div class="card card-primary">
                                <div class="card-header">
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form action="" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="niup">NIUP</label>
                                            <input type="text" name="niup" value="<?= $loadDataByNIUP["niup"] ?>"
                                                class="form-control" id="niup" placeholder="NIUP" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">NAMA</label>
                                            <input type="text" name="nama" value="<?= $loadDataByNIUP["nama"] ?>" class="
                                                form-control" id="nama" placeholder="NAMA" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenisKelamin">Jenis Kelamin</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenisKelamin"
                                                    id="laki-laki" value="laki-laki" <?= $checkedLk ?> disabled>
                                                <label class="form-check-label" for="laki-laki">Laki-laki</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="jenisKelamin"
                                                    id="perempuan" value="perempuan" <?= $checkedPR ?> disabled>
                                                <label class="form-check-label" for="perempuan">Perempuan</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="merklaptop">MERK LAPTOP</label>
                                            <input type="text" name="merklaptop"
                                                value="<?= $loadDataByNIUP["merk_laptop"] ?>" class="form-control"
                                                id="merklaptop" placeholder="MERK LAPTOP" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipelaptop">TIPE LAPTOP</label>
                                            <input type="text" name="tipelaptop"
                                                value="<?= $loadDataByNIUP["tipe_laptop"] ?>" class="form-control"
                                                id="tipelaptop" placeholder="TIPE LAPTOP" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="macaddress">MAC ADDRESS LAPTOP</label>
                                            <input type="text" name="macaddress"
                                                value="<?= $loadDataByNIUP["mac_address"] ?>" class="form-control"
                                                id="macaddress" placeholder="MAC ADDRESS LAPTOP" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="nolemari">NO LEMARI</label>
                                            <input type="text" name="nolemari"
                                                value="<?= $loadDataByNIUP["no_lemari"] ?>" class="form-control"
                                                id="nolemari" placeholder="NO LEMARI" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label>Devisi</label>
                                            <select class="form-control" name="devisi">
                                                <option
                                                    value="<?= $loadDataByNIUP["kode_devisi"] . " - " . $loadDataByNIUP["devisi"] ?>">
                                                    <?= $loadDataByNIUP["kode_devisi"] . " - " . $loadDataByNIUP["devisi"] ?>
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kamar</label>
                                            <select class="form-control" name="kamar">
                                                <option
                                                    value="<?= $loadDataByNIUP["kode_kamar"] . " - " . $loadDataByNIUP["kamar"] ?>">
                                                    <?= $loadDataByNIUP["kode_kamar"] . " - " . $loadDataByNIUP["kamar"] ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <a href="datasantri.php" type="submit" class="btn btn-warning">Kembali</a>
                                    </div>
                                </form>

                            </div>
                            <!-- /.card -->
                        </div>
                        <!--/.col (left) -->
                        <!-- right column -->
                        <div class="col-md-6">

                        </div>
                        <!--/.col (right) -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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
    <!- - AdminLTE dashboard demo (This is only for demo purposes) --!>
        <script src="../dist/js/pages/dashboard.js"></script>
</body>








</html>