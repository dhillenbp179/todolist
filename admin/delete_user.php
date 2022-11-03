<?php
session_start();
require_once "../auth/db.php";

$id = $_GET['id'];
$nama = $_GET['name'];
$query = "DELETE FROM users WHERE id_user = '$id'";
$hasil = mysqli_query($link, $query);

if ($hasil) {
    $_SESSION["sukses_hapus"] = "Data dengan Id $id dan Nama $nama Telah Berhasil Dihapus!";
    header("Location: index?page=data_users");
}
