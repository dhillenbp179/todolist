<?php
if (isset($_POST['submit'])) {
    $goal = $_POST['nm_goal'];
    $desc = $_POST['desc'];
    $user = $_SESSION['id_user'];
    if (cekSameWorkspace($goal, $link) == 0) {
        $mysql = "INSERT INTO workspace (nm_goal, deskripsi, id_user) VALUES('$goal', '$desc', $user)";
        if (mysqli_query($link, $mysql)) {
            header("Location: index?page=view_workspace");
            exit();
        }
    }
}

//fungsi untuk mengecek apakah ada workspace yg sama
function cekSameWorkspace($goal, $link)
{
    $workspace = mysqli_real_escape_string($link, $goal);
    $query = "SELECT * FROM workspace WHERE nm_goal = '$workspace' AND id_user = '$_SESSION[id_user]'";
    if ($result = mysqli_query($link, $query))
        return mysqli_num_rows($result);
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
                    <h1>Workspace Baru</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Validation</li>
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
                            <h3 class="card-title">Buat Workspace Baru</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="quickForm" action="" method="post">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="nm_goal">Nama Tujuan</label>
                                    <input type="text" name="nm_goal" class="form-control" id="nm_goal" placeholder="Berikan nama tujuan atau pekerjaan yang akan dibuat">
                                </div>
                                <div class="form-group">
                                    <label for="desc">Deskripsi</label>
                                    <textarea class="form-control" id="desc" name="desc" rows="4" placeholder="Berikan deskripsi tujuan atau pekerjaan yang akan dibuat"></textarea>
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
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                                <button type="submit" class="btn btn-default float-right" id="back">Cancel</a>
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

    <script>
        // tombol kembali
        let btnBack = document.getElementById('back');
        btnBack.addEventListener('click', () => {
            window.history.back();
        });
    </script>

</div>