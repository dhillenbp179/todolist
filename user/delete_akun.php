<?php
session_start();
require_once "../auth/db.php";

$id = $_GET['id_user'];
$query = "DELETE FROM users WHERE id_user = '$id'";
$hasil = mysqli_query($link, $query);

if ($hasil) {
    unset($_SESSION['username']);
    $_SESSION["sukses_hapus"] = "Data dengan Id $id dan Nama $nama Telah Berhasil Dihapus!";
    header("Location: index?page=profile");
}
