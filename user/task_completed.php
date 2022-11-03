<?php
require_once "../templates/navbar_user.php";

$idGoal = $_GET['id_goal'];
$query = "SELECT * FROM todo JOIN workspace
ON todo.id_goal = workspace.id_goal
WHERE todo.id_goal = $idGoal";
$todo = mysqli_query($link, $query);
$totalTodo = mysqli_num_rows($todo);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0">Task Completed</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item"><a href="index?page=view_workspace">My Workspace</a></li>
                        <li class="breadcrumb-item active">Task Completed</li>
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
            <div class="col-md-14">
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            To Do List <b> <?= $data['nm_goal']; ?></b>
                            <?php
                            if ($totalTodo < 1) : ?>
                                <small class="text-danger"> <sup> * belum ada data, silahkan tambahkan dulu data di <a href="index?page=task_incoming&id_goal=<?= $data['id_goal']; ?>&nm_goal=<?= $data['nm_goal']; ?>" class="text-warning"><b>task incoming</b></a> </sup></small>
                            <?php endif; ?>
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
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Task Completed</h5>
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
                                $query4 = "SELECT * FROM workspace
                                JOIN todo ON todo.id_goal = workspace.id_goal WHERE todo.id_goal='$id' AND status = 'selesai'";
                                $todo4 = mysqli_query($link, $query4);
                                $result4 = array();
                                while ($data4 = mysqli_fetch_assoc($todo4)) {
                                    $result4[] = $data4; //result dijadikan array 
                                }
                                foreach ($result4 as $dataTodo4) : ?>
                                    <li>
                                        <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fas fa-ellipsis-v"></i>
                                            <i class="fas fa-ellipsis-v"></i>
                                        </span>
                                        <!-- checkbox -->
                                        <div class="icheck-primary d-inline ml-4">
                                            <input type="checkbox" value="" name="todo1" id="todoCheck1">
                                            <label for="todoCheck1"></label>
                                        </div>
                                        <!-- todo text -->
                                        <span class="text"><?= $dataTodo4['title']; ?></span>
                                        <!-- Emphasis label -->
                                        <small class="badge badge-success"><i class="far fa-clock"></i> <?= $dataTodo4['deadline']; ?></small>
                                        <!-- General tools such as edit or delete-->
                                        <div class="tools">
                                            <i class="fas fa-edit text-warning" data-toggle="modal" data-target="#edit-todo<?= $dataTodo4['id_todo']; ?>"></i>
                                            <i class="fas fa-trash" data-toggle="modal" data-target="#hapus-todo<?= $dataTodo4['id_todo']; ?>"></i>
                                        </div>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="edit-todo<?= $dataTodo4['id_todo']; ?>">
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
                                                                <h6>Mengedit Todo pada Workspace <b><?= $dataTodo4['nm_goal']; ?></b></h6>
                                                                <input type="hidden" name="id_todo" value="<?= $dataTodo4['id_todo']; ?>">
                                                                <input type="hidden" name="id_goal" value="<?= $dataTodo4['id_goal']; ?>">
                                                                <div class="form-group">
                                                                    <label for="nm_todo">Nama Todo</label>
                                                                    <input type="text" class="form-control" id="nm_todo" name="title" value="<?= $dataTodo4['title']; ?>" placeholder="Masukkan Nama Todo">
                                                                </div>
                                                                <!-- Date -->
                                                                <div class="form-group">
                                                                    <label>Tanggal Deadline</label>
                                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                        <input type="text" name="deadline" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= $dataTodo4['deadline']; ?>" />
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
                                                                            <option value="<?= $status; ?>" <?= ($dataTodo4['status'] == $status) ? 'selected' : '' ?>><?= $status; ?></option>
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
                                        <div class="modal fade" id="hapus-todo<?= $dataTodo4['id_todo']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content bg-danger">
                                                    <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body bg-light">
                                                        <p>Anda Yakin Menghapus Todo <b><?= $dataTodo4['title']; ?></b>?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between bg-light">
                                                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                        <a href="delete_todo?id=<?= $dataTodo4['id_todo'] ?>&todo=<?= $dataTodo4['title'] ?>"><button type="button" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
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
                        <div class="card-footer clearfix">

                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>