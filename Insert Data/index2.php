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
  <table border="1" cellpadding="10" cellspacing="0">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Nama</th>
      <th>NISN</th>
      <th>Email</th>
      <th>Jurusan</th>
      <th>aksi</th>
    </tr>
    <?php $i = 1; foreach ($siswa as $s) : ?>
      <tr>
        <td><?= $i++; ?></td>
        <td><img src="img/<?= $s['gambar']; ?>" width="60"></td>
        <td><?= $s['nama']; ?></td>
        <td><?= $s['nisn']; ?></td>
        <td><?= $s['email']; ?></td>
        <td><?= $s['jurusan']; ?></td>
        <td><a href="">Ubah</a> | <a href="">Hapus</a></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>