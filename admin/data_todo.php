<?php

$query = "SELECT * FROM todo JOIN workspace ON workspace.id_goal=todo.id_goal JOIN users ON workspace.id_user=users.id_user";
$result = mysqli_query($link, $query);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Todo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=">Home</a></li>
                        <li class="breadcrumb-item active">Data Todo</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title col-10">Data Todo</h3>
                            <a href="index?page=add_todo"><button type="button" class="btn btn-primary btn-block col-2"><i class="fa fa-plus"></i> Add</button></a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Todo</th>
                                        <th>Title</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Goal</th>
                                        <th>User</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php while ($data = mysqli_fetch_assoc($result)) : ?>
                                        <tr>
                                            <td><?= $data['id_todo']; ?></td>
                                            <td><?= $data['title']; ?></td>
                                            <td><?= $data['deadline']; ?></td>
                                            <td><?= $data['status']; ?></td>
                                            <td><?= $data['nm_goal']; ?></td>
                                            <td><?= $data['username']; ?></td>
                                            <td>
                                                <a href="index?page=edit_todo&id_todo=<?= $data['id_todo']; ?>&id_goal=<?= $data['id_goal']; ?>"> <button class="btn btn-sm btn-primary"> Edit </button> </a>
                                                <button type="button" name="hapus_todo" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus-todo<?= $data['id_todo']; ?>">Delete</button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="hapus-todo<?= $data['id_todo']; ?>">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content bg-danger">
                                                            <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body bg-light">
                                                                <p>Anda yakin menghapus data <b><?= $data['title']; ?></b>?</p>
                                                            </div>
                                                            <div class="modal-footer justify-content-between bg-light">
                                                                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                                <a href="delete_todo.php?id_todo=<?= $data['id_todo'] ?>"><button type="button" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- Page specific script Table-->

<script>
    <?php
    if ($_SESSION["sukses_hapus"]) {
        echo "
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
            });
            Toast.fire({
            icon: 'success',
            title: '$_SESSION[sukses_hapus]',
            position: 'top'
            });";
    } else {
        echo "
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
            });
            Toast.fire({
            icon: 'danger',
            title: 'Data Gagal Dihapus!',
            text: '$_SESSION[sukses_hapus];',
            position: 'top'
            });";
    }

    unset($_SESSION['sukses_hapus']);
    ?>
</script>