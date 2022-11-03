<?php
$query = "SELECT * FROM todo JOIN workspace
ON todo.id_goal = workspace.id_goal
JOIN users ON todo.id_user = users.id_user";
$todo = mysqli_query($link, $query);

require_once "../templates/navbar_user.php";
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Incoming Task</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item"><a href="index?page=view_workspace">My Workspace</a></li>
                        <li class="breadcrumb-item active">Incoming Task</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="col-md-12">
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            To Do List <b> <?= $data['nm_goal']; ?></b>
                        </h3>

                        <div class="card-tools">
                            <ul class="pagination pagination-sm">
                                <li class="page-item"><a href="#" class="page-link">&laquo;</a></li>
                                <li class="page-item"><a href="#" class="page-link">1</a></li>
                                <li class="page-item"><a href="#" class="page-link">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-todo"><i class="fas fa-plus"></i> Tambah Todo</button>
                        </div>
                        <!-- Koding Tambah Todo -->
                        <?php
                        if (isset($_POST['tambah'])) {
                            $title = $_POST['nm_todo'];
                            $deadline = date($_POST['deadline']);
                            $status = "belum";
                            $id_goal = $_GET['id_goal'];
                            $mysql = "INSERT INTO todo (title, deadline, status, id_goal) VALUES('$title', '$deadline', '$status', '$id_goal')";
                            if (mysqli_query($link, $mysql)) {
                            }
                        }
                        ?>
                        <!-- Modal Tambah -->
                        <div class="modal fade" id="add-todo">
                            <div class="modal-dialog">
                                <div class="modal-content bg-primary">
                                    <div class="modal-header" <h6 class="modal-title">Menambahkan Todo pada Workspace</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="" method="POST">
                                        <div class="modal-body bg-light">
                                            <div class="card-body">
                                                <h6>Menambahkan Todo pada Workspace <b><?= $_GET['nm_goal']; ?></b></h6>
                                                <div class="form-group">
                                                    <label for="nm_todo">Nama Todo</label>
                                                    <input type="text" class="form-control" id="nm_todo" name="nm_todo" placeholder="Masukkan Nama Todo">
                                                </div>
                                                <!-- Date -->
                                                <div class="form-group">
                                                    <label>Tanggal Deadline</label>
                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                        <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask />
                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->

                                            <!-- <div class="card-footer">
                                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                            </div> -->

                                        </div>
                                        <div class="modal-footer justify-content-between bg-light">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" name="tambah" class="btn btn-primary swalDefaultSuccess">Tambah</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.Modal Tambah -->
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Task Incoming</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-link">#3</a>
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </div>
                            <ul class="todo-list" data-widget="todo-list">
                                <?php
                                $id = $_GET['id_goal'];
                                $query2 = "SELECT * FROM workspace
                                JOIN todo ON todo.id_goal = workspace.id_goal WHERE todo.id_goal='$id' AND status = 'belum'";
                                $todo2 = mysqli_query($link, $query2);
                                $result2 = array();
                                while ($data2 = mysqli_fetch_assoc($todo2)) {
                                    $result2[] = $data2; //result dijadikan array 
                                }
                                foreach ($result2 as $dataTodo2) : ?>
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-2">
                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text"><?= $dataTodo2['title']; ?></span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-warning"><i class="far fa-clock"></i> <?= $dataTodo2['deadline']; ?></small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit text-warning" data-toggle="modal" data-target="#edit-todo<?= $dataTodo2['id_todo']; ?>"></i>
                                            <i class="fas fa-trash" data-toggle="modal" data-target="#hapus-todo<?= $dataTodo2['id_todo']; ?>"></i>
                                        </div>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit-todo<?= $dataTodo2['id_todo']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-orange">
                                                    <div class="modal-header" <h6 class="modal-title">Edit Todo pada Workspace</h6>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="GET" action="edit_todo.php">
                                                        <div class="modal-body bg-light">
                                                            <div class="card-body">
                                                                <h6>Mengedit Todo pada Workspace <b><?= $dataTodo2['nm_goal']; ?></b></h6>
                                                                <input type="hidden" name="id_todo" value="<?= $dataTodo2['id_todo']; ?>">
                                                                <input type="hidden" name="id_goal" value="<?= $dataTodo2['id_goal']; ?>">
                                                                <div class="form-group">
                                                                    <label for="nm_todo">Nama Todo</label>
                                                                    <input type="text" class="form-control" id="nm_todo" name="title" value="<?= $dataTodo2['title']; ?>" placeholder="Masukkan Nama Todo">
                                                                </div>
                                                                <!-- Date -->
                                                                <div class="form-group">
                                                                    <label>Tanggal Deadline</label>
                                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                        <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= $dataTodo2['deadline']; ?>" />
                                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select class="custom-select" name="status" id="status">
                                                                        <?php $arrayStatus = ["belum", "telat", "selesai"];
                                                                        foreach ($arrayStatus as $status) : ?>
                                                                            <option value="<?= $status; ?>" <?= ($dataTodo2['status'] == $status) ? 'selected' : '' ?>><?= $status; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- /.card-body -->
                                                        </div>
                                                        <div class="modal-footer justify-content-between bg-light">
                                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary swalDefaultSuccess">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.Modal Edit -->

                                        <!-- Modal Hapus -->
                                        <div class="modal fade" id="hapus-todo<?= $dataTodo2['id_todo']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p>Anda Yakin Menghapus Todo <b><?= $dataTodo2['title']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                        <a href="delete_todo?id=<?= $dataTodo2['id_todo'] ?>&todo=<?= $dataTodo2['title'] ?>"><button type="button" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                        <!-- /.Modal Hapus -->
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>