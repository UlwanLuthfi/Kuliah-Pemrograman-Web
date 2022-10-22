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

function upload()
{
  $nama_file = $_FILES["gambar"]["name"];
  $tipe_file = $_FILES["gambar"]["type"];
  $ukuran_file = $_FILES["gambar"]["size"];
  $error = $_FILES["gambar"]["error"];
  $tmp_file = $_FILES["gambar"]["tmp_name"];



  // Gambar Belum di PIlih
  if ($error == 4) {
    // echo "<script>
    //           alert('Pilih Gambar Terlebih Dahulu');
    //       </script>";
    return "nophoto.png";
  }

  // Cek Tipe File
  if ($tipe_file != "image/jpeg" && $tipe_file != "image/png") {
    echo "<script>
              alert('Yang Anda Pilih Bukan Gambar2');
          </script>";
    return false;
  }

  // Cek Ekstensi File
  $daftar_gambar = ["jpg", "jpeg", "png"];
  $ekstensi_file = explode(".", $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));
  if (!in_array($ekstensi_file, $daftar_gambar)) {
    echo "<script>
              alert('Yang Anda Pilih Bukan Gambar1');
          </script>";
    return false;
  }

  // Cek Ukuran Gambar
  // Maksimal 5MB == 5000000 BYTE
  if ($ukuran_file > 2000000) {
    echo "<script>
              alert('Ukuran Gambar Terlalu Besar');
          </script>";
    return false;
  }

  // Lolos Pengecekan Siap Upload
  $nama_file_baru = uniqid();
  $nama_file_baru .= ".";
  $nama_file_baru .= $ekstensi_file;
  move_uploaded_file($tmp_file, "img/" . $nama_file_baru);

  return $nama_file_baru;
}

function tambah($data)
{
  $conn = Koneksi();

  $nama = htmlspecialchars($data['nama']);
  $nisn = htmlspecialchars($data['nisn']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  // $gambar = htmlspecialchars($data['gambar']);


  // Upload Gambar
  $gambar = upload();
  if (!$gambar) {
    return false;
  }

  $query = "INSERT INTO siswa VALUES (NULL, '$nama', '$nisn', '$email', '$jurusan', '$gambar')";

  mysqli_query($conn, $query) or die(mysqli_error($conn));

  return mysqli_affected_rows($conn);
}


function hapus($id)
{
  $conn = Koneksi();

  $mhs = query("SELECT * FROM siswa WHERE id = $id");

  if ($mhs["gambar"] != "nophoto.jpg") {
    unlink("img/" . $mhs["gambar"]);
  }

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
  $gambar_lama = htmlspecialchars($data['gambar_lama']);

  $gambar = upload();

  if (!$gambar) {
    return false;
  }

  if ($gambar == "nophoto.png") {
    $gambar = $gambar_lama;
  }

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

  // Cek Username
  if ($user = query("SELECT * FROM user WHERE username = '$username'")) {
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      header("Location: index.php");
      exit;
    }
  } else {
    return [
      'error' => true,
      'pesan' => 'Username / Password Salah'
    ];
  }
}

function registrasi($data)
{
  $conn = koneksi();

  $username = htmlspecialchars(strtolower($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // Jika Username / Password kosong
  if (empty($username) || empty($password1) || empty($password2)) {
    echo "<script>
            alert('Username / Password Tidak Boleh Kosong');
            document.location.href = 'registrasi.php';
          </>";
    return false;
  }

  // Jika username sudah ada
  if (query("SELECT * FROM user WHERE username = '$username'")) {
    echo "<script>
            alert('Username Sudah Terdaftar');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // Jika konfirmasi password tidak sesuai
  if ($password1 !== $password2) {
    echo "<script>
            alert('Konfirmasi Password Tidak Sesuai');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // Jika password < 5 digit
  if (strlen($password1) < 5) {
    echo "<script>
            alert('Password terlalu pendek(minimal 5 digit)');
            document.location.href = 'registrasi.php';
          </script>";
    return false;
  }

  // Jika Username dan Password sudah sesuai
  // Enkripsi Password
  $password_baru = password_hash($password1, PASSWORD_DEFAULT);

  // Insert data baru ke tabel user
  $query = "INSERT INTO user
              VALUE
            (null, '$username', '$password_baru')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
