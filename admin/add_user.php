<?php
$salah = '';
$validate = '';
// if (isset($_SESSION['username'])) header('Location: ../user/index');
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
    $password = stripslashes($_POST['pass']);
    $password = mysqli_real_escape_string($link, $password);
    // jika data tidak kosong
    if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password))) {
        // jika username belum terdaftar didatabase
        if (cek_nama($username, $link) == 0) {
            $pass = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username, name, email, password) VALUES ('$username', '$name', '$email', '$pass')";
            $result = mysqli_query($link, $query);
            // jika data berhasil dimasukkan ke db
            if ($result) {
                $query = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($link, $query);
                $row = mysqli_fetch_assoc($result);
                echo "<script>
                window.location.href = 'index?page=data_users';
                </script>";
                exit();
            } else {
                $salah = 'Registrasi User Gagal!';
            }
        } else {
            $salah = 'Username Telah Terdaftar!';
        }
    }
} else {
    $salah = 'Data Tidak Boleh Kosong!';
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Data Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Data Users</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="#">Masukkan ID:</label>
                                    <input type="text" class="form-control" id="#" placeholder="ID akan otomatis dibuatkan sistem" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputNama">Masukkan Nama:</label>
                                    <input type="text" class="form-control" id="inputNama" name="name" placeholder="Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputUname">Masukkan Username:</label>
                                    <input type="text" class="form-control" id="inputUname" name="username" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Masukkan Email:</label>
                                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Masukkan Password:</label>
                                    <input type="text" class="form-control" id="inputPassword" name="pass" placeholder="Password" required>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <a href="view_mahasiswa.php" class="btn btn-default float-right">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>