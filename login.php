<?php
session_start();

if (isset($_SESSION['login'])) {
  header("Location: index.php");
  exit;
}

require 'functions.php';

//ketika tombol login ditekan
if (isset($_POST['login'])) {
  $login = login($_POST);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h3>Form Login</h3>
  <?php if (!empty($login['error']) && !empty($login['pesan'])) : ?>
    <p style="color: red; font-style: italic;"><?= htmlspecialchars($login['pesan']); ?></p>
  <?php endif ?>
  <form action="" method="POST">
    <ul>
      <li>
        <label>
          username :
          <input type="text" name="username">
        </label>
      </li>
      <li>
        <label>
          Password :
          <input type="password" name="password" autofocus autocomplete="off" required>
        </label>
      </li>
      <li>
        <button type="submit" name="login" required>Login</button>
      </li>
      <li>
        <a href="registrasi.php">Tambah User Baru</a>
      </li>
    </ul>
  </form>
</body>

</html>