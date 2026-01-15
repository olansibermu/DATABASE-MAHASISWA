<?php

function koneksi()
{
  return mysqli_connect('localhost', 'root', '', 'pabd');
}

function query($query)
{
  $conn = koneksi();
  $result = mysqli_query($conn, $query);

  // jika query gagal (mis. tabel tidak ada), log error dan kembalikan array kosong
  if ($result === false) {
    error_log('MySQL error: ' . mysqli_error($conn) . " — Query: " . $query);
    return [];
  }

  # jika data hanya 1
  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function cari($keyword)
{
  $conn = koneksi();
  $keyword = mysqli_real_escape_string($conn, $keyword);
  $query = "SELECT * FROM mahasiswa WHERE 
            nama LIKE '%" . $keyword . "%' OR 
            nim LIKE '%" . $keyword . "%' OR 
            email LIKE '%" . $keyword . "%' OR 
            jurusan LIKE '%" . $keyword . "%'";
  return query($query);
}

function tambah($data)
{
  $conn = koneksi();
  $nama = htmlspecialchars($data['nama']);
  $nim = htmlspecialchars($data['nim']);
  $email = htmlspecialchars($data['email']);
  $jurusan = htmlspecialchars($data['jurusan']);
  $gambar = htmlspecialchars($data['gambar']);
  $query = "INSERT INTO
              mahasiswa
              VALUES ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function hapus($id)
{
  $conn = koneksi();
  mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
  return mysqli_affected_rows($conn);
}

function ensure_user_table($conn)
{
  $create = "CREATE TABLE IF NOT EXISTS user (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    PRIMARY KEY (id)
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";
  mysqli_query($conn, $create);
}

function registrasi($data)
{
  $conn = koneksi();

  // pastikan tabel `user` ada
  ensure_user_table($conn);

  $username = strtolower(stripslashes($data['username']));
  $password1 = mysqli_real_escape_string($conn, $data['password1']);
  $password2 = mysqli_real_escape_string($conn, $data['password2']);

  // username sudah ada?
  $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '" . $username . "'");
  if ($result && mysqli_num_rows($result) > 0) {
    return 0;
  }

  // cek konfirmasi password
  if ($password1 !== $password2) {
    return 0;
  }

  // enkripsi password
  $passwordHash = password_hash($password1, PASSWORD_DEFAULT);

  // masukkan ke tabel user
  mysqli_query($conn, "INSERT INTO user (username, password) VALUES ('" . $username . "', '" . $passwordHash . "')");
  return mysqli_affected_rows($conn);
}

function login($data)
{
  $conn = koneksi();

  // pastikan tabel `user` ada
  ensure_user_table($conn);

  $username = mysqli_real_escape_string($conn, $data['username']);
  $password = mysqli_real_escape_string($conn, $data['password']);

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '" . $username . "'");
  if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
      // sukses
      $_SESSION['login'] = true;
      return ['error' => false];
    }
  }
  return ['error' => true, 'pesan' => 'username / password salah!'];
}
