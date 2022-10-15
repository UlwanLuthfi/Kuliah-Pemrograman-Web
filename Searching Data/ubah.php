<?php 
require "function.php";

if(!isset($_GET["id"])){
  header("Location: index.php");
  exit;
}

// ambil id
$id = $_GET["id"];

// query data siswa dari id
$s = query("SELECT * FROM siswa WHERE id = $id");

if(isset($_POST['ubah'])){
  if(ubah($_POST) > 0){
    echo "<script>
            alert('Data berhasil diubah!');
            document.location.href = 'index.php';
          </script>";
  } else {
    "Data gagal ditambahkan";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Data Siswa</title>
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
  <h3>Form Ubah Data Siswa</h3>

  <form action="" method="POST">
    <input type="hidden" name="id" value="<?= $s["id"]; ?>">
    <ul>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" required value="<?= $s["nama"]; ?>">
        </label>
      </li>

      <li>
        <label>
          NISN :
          <input type="text" name="nisn" required value="<?= $s["nisn"]; ?>">
        </label>
      </li>

      <li>
        <label>
          Email :
          <input type="text" name="email" required value="<?= $s["email"]; ?>">
        </label>
      </li>

      <li>
        <label for="jurusan">
          Jurusan :
          <select name="jurusan" id="jurusan" required>
            <option value=""></option>
            <option <?= ($s["jurusan"] == "Biologi") ? "selected" : "" ?>>Biologi</option>
            <option <?= ($s["jurusan"] == "Ilmu Fisika") ? "selected" : "" ?>>Ilmu Fisika</option>
            <option <?= ($s["jurusan"] == "Ilmu Politik") ? "selected" : "" ?>>Ilmu Politik</option>
            <option <?= ($s["jurusan"] == "Ilmu Sejarah") ? "selected" : "" ?>>Ilmu Sejarah</option>
            <option <?= ($s["jurusan"] == "Ilmu Sosial") ? "selected" : "" ?>>Ilmu Sosial</option>
            <option <?= ($s["jurusan"] == "Pendidikan Intelejen") ? "selected" : "" ?>>Pendidikan Intelejen</option>
            <option <?= ($s["jurusan"] == "Psikologi") ? "selected" : "" ?>>Psikologi</option>
            <option <?= ($s["jurusan"] == "Teknik Nuklir") ? "selected" : "" ?>>Teknik Nuklir</option>
          </select>
        </label>
      </li>

      <li>
        <label>
          Gambar :
          <input type="text" name="gambar" required value="<?= $s["gambar"]; ?>">
        </label>
      </li>

      <button type="submit" name="ubah">Ubah</button>
      <button type="reset" name="reset">Reset</button>
    </ul>
  </form>
</body>
</html>