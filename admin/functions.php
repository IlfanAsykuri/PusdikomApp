<?php
$koneksi = mysqli_connect("localhost", "root", "", "db_pusdikom");


function loadData($query){
  global $koneksi;
  $result = mysqli_query($koneksi, $query);
  $data = [];
  while($hasilFetch = mysqli_fetch_assoc($result)){
    $data[] = $hasilFetch;
  }
  return $data;
}



function addDataSantri($data){
  global $koneksi;
  $niup = htmlspecialchars(ucwords(strtolower($data["niup"])));
  $nama = htmlspecialchars(ucwords(strtolower($data["nama"])));
  $jk = "l";
  if($data["jenisKelamin"] === "perempuan"){
    $jk = "p";
  }
  $macaddress = htmlspecialchars(strtoupper($data["macaddress"]));
  $merk = htmlspecialchars(ucwords(strtolower($data["merklaptop"])));
  $tipe = htmlspecialchars(ucwords(strtolower($data["tipelaptop"])));
  $lemari = htmlspecialchars($data["nolemari"]);
  $kamar = htmlspecialchars($data["kamar"]);
  $split = explode(" - ", $kamar);
  $kodeKamar = $split[0];


  // cek apakah semua input sudah terisi
  if($niup != null && $nama != null && $merk != null && $tipe != null && $lemari != null){

    // lakukan insert ke database tb_santri
    $insert =  mysqli_query($koneksi, "INSERT INTO tb_santri VALUES('$niup', '$nama', '$jk', '$macaddress', '$merk', '$tipe', '$lemari', '1', '$kodeKamar')");

    // kembalikan nilai 1 jika data berhasil di input ke database tb_santri
    return mysqli_affected_rows($koneksi);

  }else{
    return -1;
  }

}


function addDataKamar($data){
  global $koneksi;
  $kodeDevisi = $data["devisi"];
  $kodeKamar = htmlspecialchars(ucwords($data["kodekamar"]));
  $kamar = htmlspecialchars($data["namakamar"]);

  // cek apakah semua input sudah terisi
  if($kodeKamar != null && $kamar != null){

    // lakukan insert ke database tb_kamar
    $insert = mysqli_query($koneksi, "INSERT INTO tb_kamar VALUES('$kodeKamar', '$kamar', '$kodeDevisi')");

    // kembalikan nilai 1 jika data berhasil di input ke database tb_kamar
    var_dump(mysqli_error($koneksi)); die;
    return mysqli_affected_rows($koneksi);
  }else{
    return -1;
  }

}


function addDataDevisi($data){
  global $koneksi;
  $kodeDevisi = htmlspecialchars(ucwords($data["kodeDevisi"]));
  $devisi = htmlspecialchars(ucwords(strtolower($data["namaDevisi"])));

  // cek apakah semua input sudah terisi
  if($kodeDevisi != null && $devisi != null){

    // Lakukan insert ke database tb_devisi
    $insert = mysqli_query($koneksi, "INSERT INTO tb_devisi VALUES('$kodeDevisi', '$devisi')");

    // kembalikan nilai 1 jika data berhasil di input ke database tb_devisi
    return mysqli_affected_rows($koneksi);

  }else{
    return -1;
  }

}


function peminjaman($data){
  global $koneksi;
  $niup = $data["niup"];
  $tanggal = date("Y-m-d H:i:s");

  $loadData = loadData("SELECT * FROM tb_santri WHERE niup = '$niup'");

  if($loadData){
    // Lakukan insert ke database tb_peminjaman
    $insert = mysqli_query($koneksi, "INSERT INTO tb_peminjaman VALUES('', '$niup', '$tanggal', NULL, NULL)");
      if($insert){
        mysqli_query($koneksi, "UPDATE tb_santri SET status_ketersediaan = '0' WHERE niup = '$niup'");
        // var_dump(mysqli_error($koneksi)); die;
        return mysqli_affected_rows($koneksi);
      }
  }else{
    echo "
    <script>
        alert('Data tidak ditemukan!');
        document.location.href = 'index.php';
    </script>
  ";
  }

}


function pengembalian($data){
  global $koneksi;
  date_default_timezone_set('Asia/Jakarta');
  $kodePeminjaman = $data["kode_peminjaman"];
  $niup = $data["niup"];
  $tanggal = date("Y-m-d H:i:s");

  // Timestamp saat ini
  $timestamp_sekarang = time();;

  // Timestamp jam 22:30 hari ini
  $batasWaktuTelat = strtotime('today 22:30:00');

  if($timestamp_sekarang > $batasWaktuTelat){
    $updatePeminjaman = mysqli_query($koneksi, "UPDATE tb_peminjaman SET waktu_kembali = NOW(), status_peminjaman = '1' WHERE kode_peminjaman = '$kodePeminjaman'");
    if($updatePeminjaman){
      mysqli_query($koneksi, "UPDATE tb_santri SET status_ketersediaan = '1' WHERE niup = '$niup'");
      return mysqli_affected_rows($koneksi);
    }
  }else{
    $updatePeminjaman = mysqli_query($koneksi, "UPDATE tb_peminjaman SET waktu_kembali = NOW(), status_peminjaman = '0' WHERE kode_peminjaman = '$kodePeminjaman'");
    if($updatePeminjaman){
      mysqli_query($koneksi, "UPDATE tb_santri SET status_ketersediaan = '1' WHERE niup = '$niup'");
      return mysqli_affected_rows($koneksi);
    }
  }

}


function addDataAdmin($data, $files){
  global $koneksi;
  $nama = ucwords(strtolower(stripslashes(htmlspecialchars($data["nama"]))));
  $email = strtolower(stripcslashes(htmlspecialchars($data["email"])));
  $password = mysqli_real_escape_string($koneksi, $data["password"]);
  $passwordConfirm = mysqli_real_escape_string($koneksi, $data["passwordConfirm"]);

  // cek apakah email sudah ada di database atau belum
  $result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE email = '$email'");

  // jika username sudah ada maka mysqli_fetch_assoc($result["username:]) akan menghasilkan true
  if(mysqli_fetch_assoc($result)){
    echo "
    <script>
        alert('Email sudah terdaftar!');
    </script>
    ";
    return false;
  }

  // cek konfirmasi password
  if($password !== $passwordConfirm){
    echo "
    <script>
    alert('Konfirmasi password tidak sesuai');
    </script>
    ";
    return false;
  }

  // enkripsi password
  $password = password_hash($password, PASSWORD_DEFAULT);

  $foto = uploadFoto($files);

  // cek apakah function uploadFoto sukses
  if(!$foto){
    return false;
  }

  // buat id_admin secara random
  $idAdmin = uniqid();

  // tambahkan data admin ke database
  mysqli_query($koneksi, "INSERT INTO tb_admin VALUES('$idAdmin', '$nama', '$email', '$password', '$foto')");

  return mysqli_affected_rows($koneksi);

}


function uploadFoto($files){
  $namaFile = $files["foto"]["name"];
  $ukuranFile = $files["foto"]["size"];
  $error = $files["foto"]["error"];
  $tmpName = $files["foto"]["tmp_name"];

  // cek apakah tidak ada gambar yang diupload
  if($error === 4){
    echo "<script>
              alert('Pilih foto terlebih dahulu!');
          </script>";
    return false;
  }


  // cek apakah yang diupload adalah gambar
  $ekstensiValid = ["jpg", "jpeg", "png"];
  $ekstensiFile = explode('.', $namaFile);
  $ekstensiFile = mb_strtolower(end($ekstensiFile));
  if(!in_array($ekstensiFile, $ekstensiValid)){
    echo "<script>
            alert('Yang anda upload bukan gambar!');
          </script>";
    return false;
  }


  // cek jika ukurannya terlalu besar
  if($ukuranFile > 5000000){
    echo "<script>
             alert('Ukuran gambar terlalu besar');
          </script>";
    return false;
  }


  // jika lolos semua pengecekan, file siap di upload
  // generate nama file baru string 13 character
  $namaFileBaru = uniqid();
  $namaFileBaru .= ".";
  $namaFileBaru .= $ekstensiFile;

  move_uploaded_file($tmpName, '../dist/img/' . $namaFileBaru);

  return $namaFileBaru;

}


function updateDataSantri($data){
  global $koneksi;
  $niup = $data["niupHidden"];
  $nama = htmlspecialchars(ucwords(strtolower($data["nama"])));
  $jk = "l";
  if($data["jenisKelamin"] == "perempuan"){
    $jk = "p";
  }
  $merkLaptop = htmlspecialchars(ucwords(strtolower($data["merklaptop"])));
  $tipeLaptop = htmlspecialchars(ucwords(strtolower($data["tipelaptop"])));
  $macAddress = htmlspecialchars(ucwords(strtolower($data["macaddress"])));
  $noLemari = htmlspecialchars($data["nolemari"]);
  $kodeKamar = htmlspecialchars($data["kamar"]);

  // cek apakah semua input sudah terisi
  if($nama != null && $merkLaptop != null && $tipeLaptop != null && $noLemari != null){

    // lakukkan insert ke database tb_devisi
    mysqli_query($koneksi, "UPDATE tb_santri SET niup = '$niup', nama = '$nama', jk = '$jk', mac_address = '$macAddress', merk_laptop = '$merkLaptop', tipe_laptop = '$tipeLaptop', no_lemari = '$noLemari', status_ketersediaan = 1, kode_kamar = '$kodeKamar' WHERE tb_santri.niup = '$niup'");

    // kembalikan nilai 1 jika data berhasil di input ke database tb_santri
    return mysqli_affected_rows($koneksi);
  }

}


function updateDataDevisi($data){
  global $koneksi;
  $kodeDevisi = $data["kodeDevisiHidden"];
  $namaDevisi = htmlspecialchars(ucwords(strtolower($data["namaDevisi"])));

  // cek apakah semua input sudah terisi
  if($kodeDevisi != null && $namaDevisi != null){

    // lakukan update data ke database tb_devisi
    $update = mysqli_query($koneksi, "UPDATE tb_devisi SET kode_devisi = '$kodeDevisi', devisi = '$namaDevisi' WHERE tb_devisi.kode_devisi = '$kodeDevisi'");

    // kembalikan nilai 1 jika data berhasil di update
    return mysqli_affected_rows($koneksi);
  }else{
    return -1;
  }
}


function updateDataKamar($data){
  global $koneksi;
  $kodeKamar = $data["kodeKamarHidden"];
  $namaKamar = htmlspecialchars(ucwords(strtolower($data["namaKamar"])));
  $kodeDevisi = $data["devisi"];

  // cek apakah semua input sudah terisi
  if($namaKamar != null){

    // lakukan update data ke database tb_kamar
    mysqli_query($koneksi, "UPDATE tb_kamar SET kode_kamar = '$kodeKamar', kamar = '$namaKamar', kode_devisi = '$kodeDevisi' WHERE tb_kamar.kode_kamar = '$kodeKamar'");

    // kembalikan nilai 1 jika data berhasil di update
    return mysqli_affected_rows($koneksi);
  }

}


function hapusSantri($data){
  global $koneksi;
  $niup = $data["niup"];

  // delete data dati tb_santri sesuai niup
  mysqli_query($koneksi, "DELETE FROM tb_santri WHERE tb_santri.niup = '$niup'");

  // kembalikan nilai 1 jika ada data yang berhasil di delete
  return mysqli_affected_rows($koneksi);
}


function hapusDevisi($data){
  global $koneksi;
  $kodeDevisi = $data["kode_devisi"];

  // delete data dari tb_devisi sesuai kode_devisi
  mysqli_query($koneksi, "DELETE FROM tb_devisi WHERE tb_devisi.kode_devisi = '$kodeDevisi'");

  // kembalikan nilai 1 jika ada data yang berhasil di delete
  return mysqli_affected_rows($koneksi);
  }


function hapusKamar($data){
  global $koneksi;
  $kodeKamar = $data["kode_kamar"];

  // delete data dari tb_kamar sesuai kode_kamar
  mysqli_query($koneksi, "DELETE FROM tb_kamar WHERE kode_kamar = '$kodeKamar'");

  // kembalikan nilai 1 jika ada data yang berhasil di delete
  return mysqli_affected_rows($koneksi);
}


function hapusHistoryTaksaksi($data){
  global $koneksi;
  $kodePeminjaman = $data["kode_peminjaman"];

  // delete data dari tb_peminjaman sesuai kode_peminjaman
  mysqli_query($koneksi, "DELETE FROM tb_peminjaman WHERE kode_peminjaman = '$kodePeminjaman'");

  //kembalikan nilai 1 jika ada data yang berhasil di delete
  return mysqli_affected_rows($koneksi);
}


function login($data){
  global $koneksi;
  $email = $data["email"];
  $password = $data["password"];

  // cek apakah email ada atau cocok dengan yang di database
  $result = mysqli_query($koneksi, "SELECT * FROM tb_admin WHERE email = '$email'");
  if(mysqli_num_rows($result) === 1){

    // cek jika password sama dengan password yang ada di database
    $row = mysqli_fetch_assoc($result);
    if(password_verify($password, $row["password"])){
      $_SESSION["login"] = $row["id_admin"];
      header("Location: admin/index.php");
      exit;
    }
  }

  return false;
}


?>