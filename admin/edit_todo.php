<?php
$id = $_GET['id_todo'];
$get_id_goal = $_GET['id_goal'];
$query = "SELECT * FROM todo WHERE id_todo = $id";
$hasil = mysqli_query($link, $query);
$data = mysqli_fetch_assoc($hasil);

if (isset($_POST['submit'])) {
    // $id = $_POST['id_user'];
    $title = $_POST['title'];
    $deadline = $_POST['deadline'];
    $status = $_POST['pilihStatus'];
    $goal = $_POST['workspace'];
    $query = "UPDATE todo SET title='$title', deadline='$deadline', status='$status', id_goal='$goal' WHERE id_todo=$id";
    $hasil = mysqli_query($link, $query);

    if ($hasil) {
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
                    <h1>Edit Data Todo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Data Todo</li>
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
                            <h3 class="card-title">Form Edit Data Todo</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="#">Edit ID Todo:</label>
                                    <input type="text" class="form-control" id="#" placeholder="ID akan otomatis dibuatkan sistem" name="id_todo" value="<?= $data['id_todo']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputTitle">Edit Title Todo:</label>
                                    <input type="text" class="form-control" id="inputTitle" name="title" placeholder="Nama" value="<?= $data['title']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Edit Deadline</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= $data['deadline']; ?>" />
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="custom-select" name="pilihStatus" id="status">
                                        <?php $arrayStatus = ["belum", "telat", "selesai"];
                                        foreach ($arrayStatus as $status) : ?>
                                            <option value="<?= $status; ?>" <?= ($data['status'] == $status) ? 'selected' : '' ?>><?= $status; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pilihUsername">Edit Workspace</label>
                                    <select class="form-control select2bs4 select2bs4-info" data-dropdown-css-class="select2-purple" id="pilihUsername" data-placeholder="Pilih Username" name="workspace">
                                        <?php
                                        $query = mysqli_query($link, "SELECT * FROM workspace JOIN users ON workspace.id_user=users.id_user ORDER BY id_goal");
                                        while ($data = mysqli_fetch_assoc($query)) {
                                            if ($get_id_goal == $data['id_goal']) {
                                                $select = "selected";
                                            } else {
                                                $select = "";
                                            }
                                            echo "<option $select value=$data[id_goal]>$data[nm_goal] - $data[username]</option>";
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