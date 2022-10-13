<?php
require "function.php";
$siswa = query("SELECT * FROM siswa")
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
  <h3>Daftar Siswa</h3>

  <a href="tambah.php">Tambah Data Siswa</a>
  <br><br>

  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>Aksi</th>
    </tr>
    <?php $i = 1; foreach ($siswa as $s) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $s['gambar']; ?>" width="60"></td>
        <td><?= $s['nama']; ?></td>
        <td><a href="detail.php?id=<?= $s['id']; ?>">Lihat Detail</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>