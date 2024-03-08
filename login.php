<?php
session_start();
require "admin/functions.php";

if(isset($_POST["login"])){
  if(!login($_POST)){
    $error = false;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PusdikomApp</title>

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
    .error-message {
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

                    </ul>
                </nav>
            </div>

    </section>
    <!-- /.content -->
    <br>
    <br>
    <div class="row mt-5">
        <div class="col-md-4 offset-md-4">
            <!-- card start -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Log In</small></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm" action="" method="post">
                    <?php if(isset($error)) : ?>
                    <p class="error-message d-flex justify-content-center align-items-center mt-3">Email atau
                        password salah!</p>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" name="login">Log In</button>
                        <a href="index.php" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </div>
            <!-- /.card -->
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