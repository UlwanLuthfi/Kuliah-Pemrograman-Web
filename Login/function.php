<?php
function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'kuliah_pemrograman_web');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function tambah($data)
{
  $conn = Koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nisn = htmlspecialchars($data['nisn']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "INSERT INTO siswa VALUES (NULL, '$nama', '$nisn', '$email', '$jurusan', '$gambar')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}


function hapus($id)
{
  $conn = Koneksi();

  mysqli_query($conn, "DELETE FROM siswa WHERE id = $id") or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function ubah($data)
{
  $conn = Koneksi();

  $id = $data["id"];
  $nama = htmlspecialchars($data['nama']);
  $nisn = htmlspecialchars($data['nisn']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);

  $query = "UPDATE siswa SET nama = '$nama', nisn = '$nisn', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = '$id'";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}

function cari($keyword)
{
  $conn = koneksi();

  $query = "SELECT * FROM siswa 
              WHERE 
            nama LIKE '%$keyword%' OR
            nisn LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%'
            ";

  $result = mysqli_query($conn, $query);

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  return $rows;
}

function login($data)
{
  $conn = koneksi();

  $username = htmlspecialchars($data['username']);
  $password = htmlspecialchars($data['password']);

  if (query("SELECT * FROM user WHERE username = '$username' && password = '$password'")) {
    $_SESSION['login'] = true;
    header("Location: index.php");
    exit;
  } else {
    return [
      'error' => true,
      'pesan' => 'Username / Password Salah'
    ];
  }
}
