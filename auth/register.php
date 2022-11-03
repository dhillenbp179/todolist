<?php
//menyertakan file program koneksi.php pada register
require_once "db.php";
//inisialisasi session
session_start();

$salah = '';
$validate = '';
if (isset($_SESSION['username'])) header('Location: ../user/index');
//mengecek apakah data username yang diinpukan user kosong atau tidak
if (isset($_POST['submit'])) {

    // menghilangkan backshlases
    //cara sederhana mengamankan dari sql injection
    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($link, $username);
    $name = stripslashes($_POST['name']);
    $name = mysqli_real_escape_string($link, $name);
    $email = stripslashes($_POST['email']);
    $email = mysqli_real_escape_string($link, $email);
    $password = stripslashes($_POST['password']);
    $password = mysqli_real_escape_string($link, $password);
    $repass = stripslashes($_POST['repassword']);
    $repass = mysqli_real_escape_string($link, $repass);
    $fotoProfil = "new_user.png";
    // jika data tidak kosong
    if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))) {
        // jika password dan repassword sama
        if ($password == $repass) {
            // jika username belum terdaftar didatabase
            if (cek_nama($username, $link) == 0) {
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, name, email, password, foto_profil) VALUES ('$username', '$name', '$email', '$pass', '$fotoProfil')";
                $result = mysqli_query($link, $query);
                // jika data berhasil dimasukkan ke db
                if ($result) {
                    $query = "SELECT * FROM users WHERE username = '$username'";
                    $result = mysqli_query($link, $query);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['username'] = $username;
                    $_SESSION['name'] = $name;
                    $_SESSION['foto_profil'] = $row['foto_profil'];
                    $_SESSION['id_user'] = $row['id_user'];
                    header('Location: ../user/index?page=');
                } else {
                    $salah = 'Registrasi User Gagal!';
                }
            } else {
                $salah = 'Username Telah Terdaftar!';
            }
        } else {
            $validate = 'Password Tidak Sama!';
        }
    } else {
        $salah = 'Data Tidak Boleh Kosong!';
    }
}

//fungsi untuk mengecek username apakah sudah terdaftar atau belum
function cek_nama($username, $link)
{
    $nama = mysqli_real_escape_string($link, $username);
    $query = "SELECT * FROM users WHERE username = '$nama'";
    if ($result = mysqli_query($link, $query))
        return mysqli_num_rows($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page (v2)</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="register" class="h1">DAB<b>TA</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Daftar Sebagai Pengguna Baru</p>
                <?php if ($salah != '') : ?>
                    <div class="alert alert-danger" role="alert"><?= $salah ?></div>
                <?php endif; ?>
                <?php if ($validate != '') : ?>
                    <div class="alert alert-danger" role="alert"><?= $validate ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukkan Username" name="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Masukkan Email" name="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Masukkan Password" name="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Ketik Ulang Password" name="repassword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms" class="text-sm">
                                    Saya telah menyetujui untuk mendaftar.
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="login" class="text-center">Sudah punya akun? Silahkan login</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../assets/dist/js/adminlte.min.js"></script>
</body>

</html>