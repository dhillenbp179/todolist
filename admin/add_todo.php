<?php
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $status = $_POST['pilihStatus'];
    $goal = $_POST['workspace'];
    $mysql = "INSERT INTO todo (title, deadline, status, id_goal) VALUES('$title', '$deadline', '$status', '$goal')";
    if (mysqli_query($link, $mysql)) {
        echo "<script>
                window.location.href = 'index?page=data_todo';
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
                    <h1>Tambah Data Todo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Data Todo</li>
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
                            <h3 class="card-title">Form Tambah Data Todo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="#">Masukkan ID Todo:</label>
                                    <input type="text" class="form-control" id="#" placeholder="ID akan otomatis dibuatkan sistem" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">Masukkan Title:</label>
                                    <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Title" required>
                                </div>
                                <div class="form-group">
                                    <label>Masukkan Deadline</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Masukkan Status</label>
                                    <select class="custom-select" name="pilihStatus" id="status" required>
                                        <option value="belum">Belum</option>
                                        <option value="telat">Telat</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pilihUsername">Masukkan Workspace</label>
                                    <select class="form-control select2bs4 select2bs4-info" data-dropdown-css-class="select2-purple" id="pilihUsername" data-placeholder="Pilih Username" name="workspace">
                                        <?php
                                        $query = mysqli_query($link, "SELECT * FROM workspace JOIN users ON workspace.id_user=users.id_user ORDER BY id_goal");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            echo "<option value=$data[id_goal]>$data[nm_goal] - $data[username]</option>";
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
                                <a href="index?page=data_todo" class="btn btn-default float-right">Cancel</a>
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