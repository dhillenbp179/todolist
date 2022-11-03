<?php
require_once "../templates/navbar_user.php";
$queryProfil = "SELECT * FROM users WHERE id_user = $cekIdUser ";
$profil = mysqli_query($link, $queryProfil);

// query Update Profil
if (isset($_POST['update'])) {
    $id = $cekIdUser;
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // ambil isi $_FILES
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yg diupload
    if ($error === 4) {
        echo "  <script>
                    alert('Pilih gambar terlebih dahulu!');
                </script>";

        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];  // ekstensi gambar yg harus diinputkan
    $ekstensiGambar = explode('.', $namaFile);  // -> kalau punya file image.jpg maka akan dirubah menjadi sebuah array isinya ['image', 'jpg']
    $ekstensiGambar = strtolower(end($ekstensiGambar)); // -> karena yang dibutuhkan ekstensinya saja, jadi diambil isi yg terakhir

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "  <script>
                    alert('Anda tidak mengupload gambar yang sesuai!');
                </script>";
    }

    if ($ukuranFile > 1000000) {
        echo "  <script>
                    alert('Ukuran gambar terlalu besar!');
                </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../assets/img/user_profile/' . $namaFileBaru);

    $result = mysqli_query($link, "UPDATE users SET name='$name', username='$username', email='$email', foto_profil = '$namaFileBaru' WHERE id_user=$id");
    if ($result) {
        // Redirect to homepage to display updated user in list
        echo "<script>document.location.href = 'index?page=profile';</script>";
        $_SESSION['username'] = $username;
        $_SESSION['name'] = $name;
        // $_SESSION['pesan'] = 'Profil berhasil diperbarui!';
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- About Me Box -->
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">About Me</h3>
                        </div>
                        <?php while ($data = mysqli_fetch_assoc($profil)) : ?>
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle mt-4" src="../assets/img/user_profile/<?= $data['foto_profil']; ?>" alt="User profile picture">
                                <h3 class="profile-username text-center"><?= $_SESSION['name']; ?></h3>
                                <p class="text-primary text-center">@<?= $_SESSION['username']; ?></p>
                            </div>
                            <hr>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <strong><i class="fas fa-user mr-1"></i> Name</strong>
                                <p class="text-muted"><?= $data['name']; ?></p>

                                <hr>

                                <strong><i class="fas fa-user-secret mr-1"></i> Username</strong>
                                <p class="text-muted"><?= $data['username']; ?></p>
                                <hr>

                                <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
                                <p class="text-muted"><?= $data['email']; ?></p>
                                <hr>
                            </div>
                            <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#profile" data-toggle="tab">Profil</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName" value="<?= $data['name']; ?>" name="name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputUsername" value="<?= $data['username']; ?>" name="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" value="<?= $data['email']; ?>" name="email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="customFile" class="col-sm-2 col-form-label">Ubah Foto</label>
                                            <div class="custom-file col-sm-10">
                                                <input type="file" class="custom-file-input" id="customFile" name="gambar">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-primary toastrDefaultError" name="update">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                <?php endwhile; ?>
                                </div>
                                <!-- Query Ubah Passsword -->
                                <?php
                                if (isset($_POST['btnUbahPw'])) {
                                    $id = $cekIdUser;
                                    $uname = $_POST['ubahUname'];
                                    $pw = $_POST['ubahPw'];
                                    $ubahPw = password_hash($pw, PASSWORD_DEFAULT);
                                    $konfPw = $_POST['konfPw'];
                                    if (!empty($uname) && !empty($ubahPw)) {
                                        if ($uname == $_SESSION['username']) {
                                            if ($konfPw == $pw) {
                                                $query = "UPDATE users SET username = '$uname', password = '$ubahPw' WHERE id_user = $id";
                                                $hasil = mysqli_query($link, $query);
                                                if ($hasil) {
                                                    $_SESSION['pesan'] = 'Password Berhasil diubah!';
                                                }
                                            } else {
                                                $_SESSION['pesan'] = 'Konfirmasi Password Tidak Sama!';
                                            }
                                        } else {
                                            $_SESSION['pesan'] = 'Pastikan Username Benar!';
                                        }
                                    } else {
                                        $_SESSION['pesan'] = 'Data tidak boleh kosong!';
                                    }
                                }
                                ?>
                                <!-- ID Ubah Passowrd -->
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" method="POST">
                                        <h4 class="mb-3"><b>Ubah Password</b></h4>
                                        <div class="form-group row">
                                            <label for="inputUsername2" class="col-sm-2 col-form-label">Username</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputUsername2" name="ubahUname" placeholder="Username" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputPassword" class="col-sm-2 col-form-label">Password Baru</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputPassword" name="ubahPw" placeholder="Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputKonfPassword" class="col-sm-2 col-form-label">Konfirmasi Password</label>
                                            <div class="col-sm-10">
                                                <input type="password" class="form-control" id="inputKonfPassword" name="konfPw" placeholder="Konfirmasi Password" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" name="btnUbahPw" class="btn btn-primary toastrDefaultError ">Ubah</button>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <!-- Konfirmasi Hapus -->
                                    <div class="col-md-12 mt-4">
                                        <div class="card card-danger">
                                            <div class="card-header">
                                                <h3 class="card-title"><b>Hapus Akun</b></h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form action="" method="POST">
                                                    <div class="form-group">
                                                        <label for="inputUsername3">Username</label>
                                                        <input type="text" class="form-control" id="inputUsername3" placeholder="Usernmae">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword2">Password</label>
                                                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputKonfPassword3">Konfirmasi Password</label>
                                                        <input type="password" class="form-control" id="inputKonfPassword3" placeholder="Konfirmasi Password">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputKonfPassword">Alasan Menonaktifkan Akun</label>
                                                        <textarea class="form-control" id="desc" name="desc" rows="4" placeholder="Berikan deskripsi alasan anda menonaktifkan akun"></textarea>
                                                    </div>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-akun<?= $_SESSION['id_user']; ?>">
                                                        Hapus Akun <i class="fas fa-user-times"></i>
                                                    </button>
                                                </form>
                                                <!-- Modal Hapus -->
                                                <div class="modal fade" id="hapus-akun<?= $_SESSION['id_user']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Akun?</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body bg-light">
                                                                <p>Anda Yakin Menghapus Akun dengan nama <b><?= $_SESSION['name']; ?></b> dan username <b>@<?= $_SESSION['username']; ?></b>?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between bg-light">
                                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                                <a href="delete_akun?id_user=<?= $_SESSION['id_user'] ?>"><button type="button" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.Modal Hapus -->
                                            </div>

                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
require_once "../templates/footer.php";
?>

<script>
    $(function() {
        bsCustomFileInput.init();
    });
    <?php
    if ($_SESSION['pesan'] && $_SESSION['pesan'] != 'Password Berhasil diubah!') {
        echo "
        toastr.error('$_SESSION[pesan]');
        ";
    } elseif ($_SESSION['pesan'] == 'Password Berhasil diubah!') {
        echo "
        position: 'top-center',
        toastr.success('$_SESSION[pesan]');
        ";
    }
    unset($_SESSION['pesan']);
    ?>
</script>