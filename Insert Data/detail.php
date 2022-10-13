<?php 
require "function.php";

// ambil id dari url
$id = $_GET["id"];

// query siswa dari id
$s = query("SELECT * FROM siswa WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Details</title>
  <style>
    ul {
      margin: 0;
      padding: 0;
    }
    ul li{
      list-style: none;
    }
  </style>
</head>
<body>
  <h3>Detail Siswa</h3>
  <ul>
    <li><img src="img/<?= $s["gambar"]; ?>" width="80"></li>
    <li><?= $s["nama"]; ?></li>
    <li><?= $s["nisn"]; ?></li>
    <li><?= $s["email"]; ?></li>
    <li><?= $s["jurusan"]; ?></li>
    <li><a href="">Ubah</a> | <a href="">Hapus</a></li>
    <li><a href="index3.php">Kembali ke daftar siswa</a></li>
  </ul>
</body>
</html>