<?php
function content($menu)
{
    $cek = trim($menu);
    if ($cek == '') {
        $file = 'data_users.php';
    } else if ($cek == 'data_users') {
        $file = 'data_users.php';
    } else if ($cek == 'add_user') {
        $file = 'add_user.php';
    } else if ($cek == 'edit_user') {
        $file = 'edit_user.php';
    } else if ($cek == 'data_ws') {
        $file = 'data_workspace.php';
    } else if ($cek == 'edit_ws') {
        $file = 'edit_workspace.php';
    } else if ($cek == 'add_ws') {
        $file = 'add_workspace.php';
    } else if ($cek == 'data_todo') {
        $file = 'data_todo.php';
    } else if ($cek == 'add_todo') {
        $file = 'add_todo.php';
    } else if ($cek == 'edit_todo') {
        $file = 'edit_todo.php';
    } else {
        $file = 'not_found.php';
    }
    return $file;
}
