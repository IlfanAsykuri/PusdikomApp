<?php
require "functions.php";

if(isset($_GET["kode_kamar"])){
  if(hapusKamar($_GET) > 0){
     echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'dataKamarDevisi.php';
    </script>
";
}else{
    echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href = 'dataKamarDevisi.php';
    </script>
";
}
}




?>
