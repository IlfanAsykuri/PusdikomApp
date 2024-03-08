<?php
require "functions.php";

if(isset($_GET["niup"])){
  if(hapusSantri($_GET) > 0){
     echo "
    <script>
        alert('Data berhasil dihapus!');
        document.location.href = 'datasantri.php';
    </script>
";
}else{
    echo "
    <script>
        alert('Data gagal dihapus!');
        document.location.href = 'datasantri.php';
    </script>
";
}
}




?>
