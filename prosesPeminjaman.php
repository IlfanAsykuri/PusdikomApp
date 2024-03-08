<?php
require "admin/functions.php";

if(isset($_GET["niup"])){
  if(peminjaman($_GET) > 0){
    echo "
    <script>
        alert('Laptop berhasil di pinjam!');
        document.location.href = 'index.php';
    </script>
  ";
  }else{
    echo "
    <script>
        alert('Laptop gagal di pinjam!');
        document.location.href = 'index.php';
    </script>
  ";

  }
}



?>
