<?php

function select($query) {
  global $mysqli;
  $result = mysqli_query($mysqli, $query);
  $data = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }
  return $data;
}

// Menambah data barang
function create_barang($post) {
  global $mysqli;
  $nama = $post["nama"];
  $jumlah = $post["jumlah"];
  $harga = $post["harga"];
  // $tanggal = date("Y-m-d H:i:s");

  // Query tambah data
  $query = "INSERT INTO barang (nama, jumlah, harga, tanggal) VALUES ('$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

  // Eksekusi query
  mysqli_query($mysqli, $query);

  return mysqli_affected_rows($mysqli);
}

// Mengubah data barang
function ubah_barang($post) {
  global $mysqli;
  $id_barang = $post["id_barang"];
  $nama = $post["nama"];
  $jumlah = $post["jumlah"];
  $harga = $post["harga"];
  // $tanggal = date("Y-m-d H:i:s");

  // Query ubah data
  $query = "UPDATE barang SET nama = '$nama', jumlah = '$jumlah', harga = '$harga' WHERE id_barang = $id_barang";

  // Eksekusi query
  mysqli_query($mysqli, $query);

  return mysqli_affected_rows($mysqli);
}

function delete_barang($id_barang) {
  global $mysqli;

  // Query hapus data
  $query = "DELETE FROM barang WHERE id_barang = $id_barang";

  return mysqli_query($mysqli, $query);
} 

function create_akun($post) {
  global $mysqli;
  $nama = strip_tags($post["nama"]);
  $username =strip_tags($post["username"]);
  $email = strip_tags($post["email"]);
  $password = strip_tags($post["password"]);
  $level = strip_tags($post["level"]);

  // Query tambah data
  $query = "INSERT INTO akun VALUES (null, '$nama', '$username', '$email', '$password', '$level')";

  mysqli_query($mysqli, $query);

  return mysqli_affected_rows($mysqli);
}

function ubah_akun($post) {
  global $mysqli;

  $id_akun = strip_tags($post["id_akun"]);
  $nama = strip_tags($post["nama"]);
  $username =strip_tags($post["username"]);
  $email = strip_tags($post["email"]);
  $password = strip_tags($post["password"]);
  $level = strip_tags($post["level"]);

  // Query tambah data
  $query = "UPDATE akun SET nama_akun = '$nama', username = '$username', email = '$email', password =  '$password', level = '$level' WHERE id_akun = $id_akun";

  mysqli_query($mysqli, $query);

  return mysqli_affected_rows($mysqli);
}


function delete_akun($id_akun) {
  global $mysqli;

  // Query hapus data
  $query = "DELETE FROM akun WHERE id_akun = $id_akun";

  mysqli_query($mysqli, $query);

  return mysqli_query($mysqli, $query);
} 