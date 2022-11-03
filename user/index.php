<?php
require_once "../templates/header.php";
include 'fungsi_halaman.php';

//menampilkan content yang diinginkan
if (!isset($_GET['page'])) {
    $_GET['page'] = null;
}
$file = content($_GET['page']);
include "$file";

require_once "../templates/footer.php";
