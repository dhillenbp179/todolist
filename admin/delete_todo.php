<?php
session_start();
require_once "../auth/db.php";

$id = $_GET['id_todo'];
$query = "DELETE FROM todo WHERE id_todo = '$id'";
$hasil = mysqli_query($link, $query);

if ($hasil) {
    $_SESSION["sukses_hapus"] = "Data dengan Id $id dan Nama $nama Telah Berhasil Dihapus!";
    header("Location: index?page=data_todo");
}
