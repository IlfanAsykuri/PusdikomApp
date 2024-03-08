<?php

require "admin/functions.php";

$dataPeminjaman = loadData("SELECT * FROM tb_peminjaman AS p JOIN tb_santri AS s ON p.niup = s.niup WHERE DATE(waktu_pinjam) = CURDATE() AND waktu_kembali IS NULL AND status_ketersediaan = '0'");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PusdikomApp</title>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- font Awesome -->
    <script src="https://kit.fontawesome.com/1f8a12df3e.js" crossorigin="anonymous"></script>
    <style>
    .no-data {
        background-color: #dc3545;
        /* Merah */
        color: #fff;
        /* Putih */
        font-style: italic;
        /* Cetak miring */
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    </style>
</head>

<body class="hold-transition sidebar-mini">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand navbar-info navbar-dark">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="navbar-brand">
                            <h4>PusdikomApp</h4>
                        </li>
                    </ul>

                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="login.php">
                                <p>Login
                                    <i class="far fa-solid fa-right-from-bracket"></i>
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

    </section>
    <!-- /.content -->
    <br>
    <br>
    <div class="col-md-8 offset-md-3 mt-3">
        <div class="row">
            <div class="col-md-4 col-4">
                <!-- small box -->
                <div class="small-box bg-warning" style="height: 200px;">
                    <div class="inner">
                        <h3>Piminjaman</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <a href="peminjaman.php" class="small-box-footer"
                        style="position: absolute; bottom: 0; width: 100%; height: 50px; text-align: center;"><i
                            class="fa-solid fa-circle-arrow-left"></i> Pinjam</a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-md-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success" style="height: 200px;">
                    <div class="inner">
                        <h3>Pengembalian</h3>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                    <a href="pengembalian.php" class="small-box-footer"
                        style="position: absolute; bottom: 0; width: 100%; height: 50px; text-align: center;">Kembalikan
                        <i class="fa-solid fa-circle-arrow-right"></i> </a>
                </div>
            </div>
            <!-- ./col -->

            <section class="col-md-8 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Laptop Dipinjam Hari ini</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <?php if(!$dataPeminjaman){ ?>
                        <p class="no-data d-flex justify-content-center align-items-center mt-3">Tidak ada
                            peminjaman hari ini!</p>
                        <?php }else{ ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">NO</th>
                                    <th>NAMA</th>
                                    <th>MERK LAPTOP</th>
                                    <th>TIPE LAPTOP</th>
                                    <th>NO LEMARI</th>
                                    <th style="width: 40px">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach($dataPeminjaman as $peminjaman) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $peminjaman["nama"]; ?></td>
                                    <td><?= $peminjaman["merk_laptop"]; ?></td>
                                    <td><?= $peminjaman["tipe_laptop"]; ?></td>
                                    <td><?= $peminjaman["no_lemari"]; ?></td>
                                    <td><span class="badge bg-danger">Dipinjam</span></td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php } ?>
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
    </div>





    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- <!- - AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js"></script> -->
</body>



</html>
