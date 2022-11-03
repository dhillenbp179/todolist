<?php
$id = $_GET['id_ws'];
$id_user = $_GET['id_user'];
$query = "SELECT * FROM workspace WHERE id_goal = $id";
$hasil = mysqli_query($link, $query);
$data = mysqli_fetch_assoc($hasil);

if (isset($_POST['submit'])) {
    // $id = $_POST['id_user'];
    $nm_goal = $_POST['nm_goal'];
    $deskripsi = $_POST['deskripsi'];
    $user = $_POST['user'];
    $query = "UPDATE workspace SET nm_goal='$nm_goal', deskripsi='$deskripsi', id_user='$user' WHERE id_goal=$id";
    $hasil = mysqli_query($link, $query);

    if ($hasil) {
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
                    <h1>Edit Data Workspace</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Data Workspace</li>
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
                            <h3 class="card-title">Form Edit Data Workspace</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="#">Masukkan ID Goal:</label>
                                    <input type="text" class="form-control" id="#" placeholder="ID akan otomatis dibuatkan sistem" name="id_goal" value="<?= $data['id_goal']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputNamaGoal">Masukkan Nama Goal:</label>
                                    <input type="text" class="form-control" id="inputNamaGoal" name="nm_goal" placeholder="Nama" value="<?= $data['nm_goal']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputDeskripsi">Masukkan Deskripsi:</label>
                                    <input type="text" class="form-control" id="inputDeskripsi" name="deskripsi" placeholder="Username" value="<?= $data['deskripsi']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Masukkan User:</label>
                                    <select class="form-control select2bs4 select2bs4-info" data-dropdown-css-class="select2-purple" id="pilihUsername" data-placeholder="Pilih Username" name="user">
                                        <?php
                                        // query menampilkan semua kategori dalam combobox
                                        $query = mysqli_query($link, "SELECT * FROM users ORDER BY id_user");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            if ($id_user == $data['id_user']) {
                                                $select = "selected";
                                            } else {
                                                $select = "";
                                            }
                                            echo "<option $select value=$data[id_user]>$data[username]</option>";
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