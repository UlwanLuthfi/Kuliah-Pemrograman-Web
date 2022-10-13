<?php 
require "function.php";

if(isset($_POST['tambah'])){
  if(tambah($_POST) > 0){
    echo "<script>
            alert('Data berhasil ditambahkan!');
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
  <title>Tambah Data Siswa</title>
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
  <h3>Form Tambah Data Siswa</h3>

  <form action="" method="POST">
    <ul>
      <li>
        <label>
          Nama :
          <input type="text" name="nama" required>
        </label>
      </li>

      <li>
        <label>
          NISN :
          <input type="text" name="nisn" required>
        </label>
      </li>

      <li>
        <label>
          Email :
          <input type="text" name="email" required>
        </label>
      </li>

      <li>
        <label for="jurusan">
          Jurusan :
          <select name="jurusan" id="jurusan" required>
            <option value=""></option>
            <option value="Biologi">Biologi</option>
            <option value="Ilmu Fisika">Ilmu Fisika</option>
            <option value="Ilmu Politik">Ilmu Politik</option>
            <option value="Ilmu Sejarah">Ilmu Sejarah</option>
            <option value="Ilmu Sosial">Ilmu Sosial</option>
            <option value="Pendidikan Intelejen">Pendidikan Intelejen</option>
            <option value="Psikologi">Psikologi</option>
            <option value="Teknik Nuklir">Teknik Nuklir</option>
          </select>
        </label>
      </li>

      <li>
        <label>
          Gambar :
          <input type="text" name="gambar" required>
        </label>
      </li>

      <button type="submit" name="tambah">Submit</button>
      <button type="reset" name="reset">Reset</button>
    </ul>
  </form>
</body>
</html>