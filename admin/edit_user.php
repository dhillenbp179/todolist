<?php
$id = $_GET['id_user'];
$query = "SELECT * FROM users WHERE id_user = $id";
$hasil = mysqli_query($link, $query);
$data = mysqli_fetch_assoc($hasil);

if (isset($_POST['submit'])) {
    // $id = $_POST['id_user'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $query = "UPDATE users SET name='$name', username='$username', email='$email', password='$pass' WHERE id_user=$id";
    $hasil = mysqli_query($link, $query);

    if ($hasil) {
        echo "<script>
                window.location.href = 'index?page=data_users';
                </script>";
        exit();
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
                    <h1>Edit Data User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Data User</li>
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
                            <h3 class="card-title">Form Edit Data User</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="#">Masukkan ID:</label>
                                    <input type="text" class="form-control" id="#" placeholder="ID akan otomatis dibuatkan sistem" name="id_user" value="<?= $data['id_user']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputNama">Masukkan Nama:</label>
                                    <input type="text" class="form-control" id="inputNama" name="name" placeholder="Nama" value="<?= $data['name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputUsername">Masukkan Username:</label>
                                    <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username" value="<?= $data['username']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Masukkan Email:</label>
                                    <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Email" value="<?= $data['email']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Masukkan Password:</label>
                                    <input type="text" class="form-control" id="inputPassword" name="password" placeholder="Password" value="<?= $data['password']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Masukkan Foto:</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <a href="index?page=data_users" class="btn btn-default float-right">Cancel</a>
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