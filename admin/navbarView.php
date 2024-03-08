<?php
$url = "/phpdasar/PusdikomApp/admin/navbarView.php";
if($_SERVER["REQUEST_URI"] == $url ){
  header("Location: index.php");
  exit;
}




?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" href="logout.php">
                <p>Logout
                    <i class="far fa-solid fa-right-from-bracket"></i>
                </p>
            </a>
        </li>
    </ul>
</nav>
