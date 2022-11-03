<?php
session_start();
require_once "../auth/db.php";

$id = $_GET['id_todo'];
$title = $_GET['title'];
$dl = $_GET['deadline'];
$status = $_GET['status'];
$goal = $_GET['id_goal'];
$queryTd = "UPDATE todo SET title = '$title', deadline = '$dl', status = '$status', id_goal='$goal' WHERE id_todo = $id";
$hasil = mysqli_query($link, $queryTd);

if ($hasil) {
    header("Location: index?page=view_workspace");
}
