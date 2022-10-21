<?php
require "function.php";

if (isset($_POST['registrasi'])) {
  if (registrasi($_POST) > 0) {
    echo "<script>
            alert('User Baru Berhasil Ditambahkan, Silahkan Login');
            document.location.href = 'login.php';
          </script>";
  } else {
    echo "User Gagal Ditambahkan";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi</title>
  <style>
    ul {
      margin: 0;
      padding: 0;
    }

    ul li {
      list-style: none;
    }
  </style>
</head>

<body>
  <h3>Form Registrasi</h3>

  <form action="" method="POST">
    <ul>
      <li>
        <label>
          Username :
          <input type="text" name="username" required>
        </label>
      </li>

      <li>
        <label>
          Password :
          <input type="password" name="password1" required>
        </label>
      </li>

      <li>
        <label>
          Konfirmasi Password
          <input type="password" name="password2" required>
        </label>
      </li>

      <li>
        <button type="submit" name="registrasi">Registrasi</button>
      </li>
    </ul>
  </form>
</body>

</html>