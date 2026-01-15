<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require 'functions.php';

//jika id tidak ada di URL
if (!isset($_GET['id'])) {
  header("location: index.php");
  exit;
}

//ambil id dari url
$id = $_GET['id'];

//query mahasiswa berdasarkan id
$m = query("SELECT * FROM mahasiswa WHERE id=$id");

//cek apaah tombol ubah sudah di klik
if (isset($_POST['ubah'])) {
  if (ubah($_POST) > 0) {
    echo "<script>
          alert ('data berhasil diubah');
          document.location.href='index.php';
          </script>";
  } else {
    echo "<script>
          alert ('data gagal diubah');
          document.location.href='index.php';
          </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Mahasiswa</title>
</head>

<body>
  <h1>Form Ubah Data Mahasiswa</h1>
  <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value=<?= $m['id']; ?>>
    <ul>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" autofocus required value="<?= $m['nama']; ?>">
        </label>
      </li>
      <li>
        <label>
          NIM :
          <input type="text" name="nim" required value="<?= $m['nim']; ?>">
        </label>
      </li>
      <li>
        <label>
          E-mail :
          <input type="text" name="email" required value="<?= $m['email']; ?>">
        </label>
      </li>
      <li>
        <label>
          Jurusan :
          <input type="text" name="jurusan" required value="<?= $m['jurusan']; ?>">
        </label>
      </li>
      <li>
        <input type="hidden" name="gambar_lama" value="<?= $m['gambar']; ?>">
        <label>
          Gambar :
          <input type="file" name="gambar" class="gambar" onchange="previewImage()">
        </label>
        <img src="img/<?= $m['gambar']; ?>" width="120" style="display:block;" class="img-preview">
      </li>
      <li>
        <button type="submit" name="ubah"> Ubah Data! </button>
      </li>
    </ul>
  </form>
  <script src="js/script.js"></script>
</body>

</html>