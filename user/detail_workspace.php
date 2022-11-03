<?php
$id = $_GET['id'];
$queryWp = "SELECT * FROM workspace WHERE id_goal = $id";
$hasil = mysqli_query($link, $queryWp);
$dataWp = mysqli_fetch_assoc($hasil);
if (isset($_POST['submit'])) {
    $nama = $_POST['nm_goal'];
    $desc = $_POST['desc'];
    $user = $_SESSION['id_user'];
    $queryWp = "UPDATE workspace SET nm_goal = '$nama', deskripsi = '$desc', id_user = '$user' WHERE id_goal = $id";
    $hasil = mysqli_query($link, $queryWp);
    // var_dump($hasil);
    // die;
    if ($hasil) {
        header("Location: index?page=view_workspace");
    }
}

require_once "../templates/navbar_user.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Workspace</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item"><a href="index?page=view_workspace">My Workspace</a></li>
                        <li class="breadcrumb-item active">Edit Workspace</li>
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
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-purple">
                        <div class="card-header">
                            <h3 class="card-title">Edit Workspace</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nm_goal">Nama Tujuan</label>
                                    <input type="text" name="nm_goal" class="form-control" id="nm_goal" value="<?= $dataWp['nm_goal']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <textarea class="form-control" id="desc" name="desc" rows="4"><?= $dataWp['deskripsi']; ?></textarea>
                                </div>
                                <div class="form-group mb-0">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                                        <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <a href="index?page=view_workspace" class="btn btn-outline-primary float-right">Kembali ke My Workspace</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>
    function back() {
        window.history.back()
    }
</script>