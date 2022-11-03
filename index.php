<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location:user/?page=');
} else {
    //alihkan ke halaman login
    header("location:auth/login");
}
