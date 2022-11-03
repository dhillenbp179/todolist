<?php
require_once "db.php";
session_start();
$error = '';
$validate = '';
if (isset($_SESSION['username'])) {
    header('Location: ../user/index?page=');
}

// jika tombol submit di tekan
if (isset($_POST['submit'])) {
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($link, $username);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($link, $password);
    // jika username dan password tidak kosong
    if (!empty(trim($username)) && !empty(trim($password))) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($link, $query);
        $rows = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        // jika hasil data yang login sesuai dengan database
        if ($rows != 0) {
            $hash = $row['password'];
            // jika dekripsi password sesuai dengan database
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $row["username"];
                $_SESSION['name'] = $row['name'];
                $_SESSION['foto_profil'] = $row['foto_profil'];
                $_SESSION['id_user'] = $row['id_user'];
                header('Location: ../user/index?page=');
            } else {
                $error = 'Password Salah!!!';
            }
        } else {
            $error = 'Login User Gagal!!!';
        }
    } else {
        $error = 'Data Tidak Boleh Kosong!!!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dabta | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-purple">
            <?php if ($error != '') : ?>
                <div class="alert alert-danger" role="alert"><?= $error ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['msg'])) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['msg'];
                    unset($_SESSION['msg']) ?>
                </div>
            <?php endif; ?>
            <div class="card-header text-center">
                <a href="login" class="h1">DAB<b>TA</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Masuk untuk menggunakan aplikasi</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-purple">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <?php if ($validate != '') : ?>
                        <p class="text-danger"><?= $validate ?></p>
                    <?php endif; ?>
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Sign in <i class="fa fa-sign-in-alt ml-1"></i></button>
                    </div>
                    <!-- /.Button Sign in -->
                </form>
                <p class="mb-1">
                    <a href="forgot-password.html">Lupa Password?</a>
                </p>
                <p class="mb-0">
                    <a href="register" class="text-center">Belum punya akun? Daftar disini!</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>