<?php

function content($menu)
{
    $cek = trim($menu);
    if ($cek == '') {
        $file = 'beranda.php';
    } elseif ($cek == 'beranda') {
        $file = 'beranda.php';
    } elseif ($cek == 'view_workspace') {
        $file = 'view_workspace.php';
    } elseif ($cek == 'add_workspace') {
        $file = 'add_workspace.php';
    } elseif ($cek == 'detail_workspace') {
        $file = 'detail_workspace.php';
    } elseif ($cek == 'task_incoming') {
        $file = 'task_incoming.php';
    } elseif ($cek == 'task_overdue') {
        $file = 'task_overdue.php';
    } elseif ($cek == 'task_completed') {
        $file = 'task_completed.php';
    } elseif ($cek == 'profile') {
        $file = 'profile.php';
    } elseif ($cek == 'data_user') {
        $file = 'data_user.php';
    } elseif ($cek == 'tambah_user') {
        $file = 'tambah_user.php';
    } elseif ($cek == 'edit_user') {
        $file = 'edit_user.php';
    } elseif ($cek == 'delete_user') {
        $file = 'delete_user.php';
    } else {
        $file = 'not_found.php';
    }
    return $file;
}
