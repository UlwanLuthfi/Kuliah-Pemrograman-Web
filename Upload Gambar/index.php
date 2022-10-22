<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

require "function.php";

$siswa = query("SELECT * FROM siswa");

if (isset($_POST["cari"])) {
  $siswa = cari($_POST["keyword"]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Koneksi DB</title>
</head>

<body>

  <a href="logout.php">Logout</a>

  <h3>Daftar Siswa</h3>

  <a href="tambah.php">Tambah Data Siswa</a>
  <br><br>

  <form action="" method="POST">
    <input type="text" name="keyword" size="36" class="keyword">
    <button type="submit" name="cari" class="tombol-cari">Cari</button>
  </form>

  <br>

  <div class="container">
    <table border="1" cellpadding="10" cellspacing="0">
      <tr>
        <th>#</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Aksi</th>
      </tr>

      <?php if (empty($siswa)) : ?>
        <tr>
          <td colspan="4" align="center">
            <p>Data Siswa Tidak Ditemukan!</p>
          </td>
        </tr>
      <?php endif; ?>

      <?php $i = 1;
      foreach ($siswa as $s) : ?>
        <tr>
          <td><?= $i++; ?></td>
          <td><img src="img/<?= $s['gambar']; ?>" width="60"></td>
          <td><?= $s['nama']; ?></td>
          <td><a href="detail.php?id=<?= $s['id']; ?>">Lihat Detail</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <script src="js/script.js"></script>
</body>

</html>