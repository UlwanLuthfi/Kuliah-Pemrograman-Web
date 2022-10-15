<?php 
session_start();
if (!isset($_SESSION['login'])){
  header("Location: login.php");
}

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
    <li>Nama    : <?= $s["nama"]; ?></li>
    <li>NISN    : <?= $s["nisn"]; ?></li>
    <li>Email   : <?= $s["email"]; ?></li>
    <li>Jurusan : <?= $s["jurusan"]; ?></li>
    <li><a href="ubah.php?id=<?= $s["id"]; ?>">Ubah</a> | <a href="hapus.php?id=<?= $s["id"]; ?>" onclick="return confirm('Apakah anda yakin?');">Hapus</a></li>
    <li><a href="index.php">Kembali ke daftar siswa</a></li>
  </ul>
</body>
</html>