<?php
require "functions.php";

if(isset($_GET["kode_peminjaman"])){
  if(hapusHistoryTaksaksi($_GET) > 0){
     echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'historyTran saksi.php';
    </script>
";
}else{
    echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href = 'historyTransaksi.php';
    </script>
";
}
}




?>