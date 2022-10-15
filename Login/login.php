<?php
session_start();
if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require "function.php";

if (isset($_POST['login'])) {
  $login = login($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
  <h3>Form Login</h3>

  <?php if (isset($login['error'])) : ?>
    <p><?= $login['pesan']; ?></p>
  <?php endif; ?>

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
          <input type="text" name="password" required>
        </label>
      </li>

      <li>
        <button type="submit" name="login">Login</button>
      </li>
    </ul>
  </form>
</body>

</html>