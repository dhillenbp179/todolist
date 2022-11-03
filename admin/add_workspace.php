<?php
if (isset($_POST['submit'])) {
    $goal = $_POST['nm_goal'];
    $desc = $_POST['deskripsi'];
    $user = $_POST['user'];
    $mysql = "INSERT INTO workspace (nm_goal, deskripsi, id_user) VALUES('$goal', '$desc', $user)";
    if (mysqli_query($link, $mysql)) {
        echo "<script>
                window.location.href = 'index?page=data_ws';
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
                    <h1>Tambah Data Workspace</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Data Workspace</li>
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
                            <h3 class="card-title">Form Tambah Data Workspace</h3>
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
                                    <label for="inputNamaGoal">Masukkan Nama Goal:</label>
                                    <input type="text" class="form-control" id="inputNamaGoal" name="nm_goal" placeholder="Nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputDeskripsi">Masukkan Deskripsi:</label>
                                    <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi" placeholder="Deskripsi" required>
                                </div>
                                <div class="form-group">
                                    <label for="pilihUsername">Masukkan User</label>
                                    <select class="form-control select2bs4 select2bs4-info" data-dropdown-css-class="select2-purple" id="pilihUsername" data-placeholder="Pilih Username" name="user">
                                        <?php
                                        $query = mysqli_query($link, "SELECT * FROM users ORDER BY id_user");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            echo "<option value=$data[id_user]>$data[username]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <a href="index?page=data_ws" class="btn btn-default float-right">Cancel</a>
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