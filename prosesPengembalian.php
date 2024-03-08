<?php
require "admin/functions.php";

if(isset($_GET["kode_peminjaman"])){
  if(pengembalian($_GET) > 0){
    echo "
    <script>
        alert('Laptop berhasil di kembalian!');
        document.location.href = 'index.php';
    </script>
  ";
  }else{
    echo "
    <script>
        alert('Laptop gagal di kembalikan!');
        document.location.href = 'index.php';
    </script>
  ";

  }
}



?>