<?php
require "admin/functions.php";

$allPeminjaman = loadData("SELECT * FROM tb_peminjaman AS p JOIN tb_santri AS s JOIN tb_kamar AS k JOIN tb_devisi AS d ON p.niup = s.niup AND s.kode_kamar = k.kode_kamar AND k.kode_devisi = d.kode_devisi WHERE p.waktu_kembali IS NULL");

if(isset($_POST["cari"])){
  $keyword = $_POST["keyword"];
  $allPeminjaman = loadData("SELECT * FROM tb_peminjaman AS p JOIN tb_santri AS s JOIN tb_kamar AS k JOIN tb_devisi AS d ON p.niup = s.niup AND s.kode_kamar = k.kode_kamar AND k.kode_devisi = d.kode_devisi WHERE (s.niup LIKE '%$keyword%' OR s.nama LIKE '%$keyword%') AND p.waktu_kembali IS NULL");
}

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

    <div class="row">
        <div class="col-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pengembalian Laptop</h3>
                    <div class="card-tools">
                        <form action="" method="post">
                            <div class="input-group input-group-sm" style="width: 250px;">
                                <input type="text" name="keyword" class="form-control float-right" placeholder="Search">
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
                <div class="card-body table-responsive p-0" style="height: 500px;">
                    <?php if(!$allPeminjaman){ ?>
                    <p class="no-data d-flex justify-content-center align-items-center mt-3">Tidak ada
                        peminjaman hari ini!</p>
                    <?php }else{ ?>
                    <table class="table table-head-fixed table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIUP</th>
                                <th>NAMA</th>
                                <th>JENIS KELAMIN</th>
                                <th>KAMAR</th>
                                <th>DEVISI</th>
                                <th>MERK LAPTOP</th>
                                <th>NO LEMARI</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                          $i = 1;
                          foreach($allPeminjaman as $peminjaman) :
                          ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $peminjaman["niup"] ?></td>
                                <td><?= $peminjaman["nama"] ?></td>
                                <?php if($peminjaman["jk"] == "l"){ ?>
                                <td>Laki-laki</td>
                                <?php }else{ ?>
                                <td>Perempuan</td>
                                <?php } ?>
                                <td><?= $peminjaman["kamar"] ?></td>
                                <td><?= $peminjaman["devisi"] ?></td>
                                <td><?= $peminjaman["merk_laptop"] ?></td>
                                <td><?= $peminjaman["no_lemari"] ?></td>
                                <td>
                                    <a href="prosesPengembalian.php?kode_peminjaman=<?= $peminjaman["kode_peminjaman"] ?>&niup=<?= $peminjaman["niup"] ?>"
                                        class="btn btn-sm btn-success">Kembalikan <i
                                            class="fa-solid fa-right-to-bracket"></i></a>
                                </td>
                            </tr>
                            <?php $i++ ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php } ?>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li><a href="index.php" class="btn btn-warning">Kembali <i
                                    class="fa-solid fa-circle-arrow-right"></i></a></li>
                    </ul>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->






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