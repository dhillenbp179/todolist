<?php
require_once "../templates/navbar_user.php";
$queryCekUser = "SELECT * FROM workspace WHERE id_user = $cekIdUser ";
$todo = mysqli_query($link, $queryCekUser);
$result = array();
while ($data = mysqli_fetch_assoc($todo)) {
    $result[] = $data; //result dijadikan array 
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper kanban pb-5">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>My Workspace</h1>
                    <a href="index?page=add_workspace" class="btn btn-primary">Buat Workspace Baru <i class="fas fa-plus"></i></a>
                </div>
                <div class="col-sm-6 d-none d-sm-block">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index?page=beranda">Home</a></li>
                        <li class="breadcrumb-item active mb-3">My Workspace</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content pb-3">
        <div class="container-fluid h-100">
            <?php $no = 1; ?>
            <?php foreach ($result as $dataTodo) : ?>
                <div class="card card-row card-purple mb-4 mr-3">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="#" class="btn btn-tool btn-link">#<?= $no; ?></a>
                            <b><?= $dataTodo['nm_goal']; ?></b>
                        </h3>
                        <div class="card-tools">
                            <a href="index?page=detail_workspace&id=<?= $dataTodo['id_goal']; ?>" type="button" class="btn btn-tool" data-card-widget="pen" title="Pen">
                                <small><i class="fas fa-pen"></i></small>
                            </a>
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#hapus-workspace<?= $dataTodo['id_goal']; ?>">
                                <i class="fas fa-times"></i>
                            </button>
                            <!-- Modal Hapus -->
                            <div class="modal fade" id="hapus-workspace<?= $dataTodo['id_goal']; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-header" <h4 class="modal-title">Anda Yakin Ingin Menghapus Data?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <p>Anda Yakin Menghapus Workspace <b><?= $dataTodo['nm_goal']; ?></b>?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between bg-light">
                                            <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                            <a href="delete_workspace?id=<?= $dataTodo['id_goal'] ?>&goal=<?= $dataTodo['nm_goal'] ?>"><button type="button" class="btn btn-danger swalDefaultSuccess">Hapus</button></a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.Modal Hapus -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-warning card-outline">
                            <div class="card-header">
                                <h5 class="card-title"><b>Task Incoming</b></h5>
                                <div class="card-tools">
                                    <a href="index?page=task_incoming&id_goal=<?= $dataTodo['id_goal']; ?>&nm_goal=<?= $dataTodo['nm_goal']; ?>" class="btn btn-tool">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $id = $dataTodo['id_goal'];
                                $query2 = "SELECT * FROM workspace
                                JOIN todo ON todo.id_goal = workspace.id_goal WHERE todo.id_goal='$id' AND status = 'belum'";
                                $todo2 = mysqli_query($link, $query2);
                                $result2 = array();
                                while ($data2 = mysqli_fetch_assoc($todo2)) {
                                    $result2[] = $data2; //result dijadikan array 
                                }
                                foreach ($result2 as $dataTodo2) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                                        <label for="customCheckbox1" class="custom-control-label"><?= $dataTodo2['title']; ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card card-danger card-outline">
                            <div class="card-header">
                                <h5 class="card-title"><b>Task Overdue</b></h5>
                                <div class="card-tools">
                                    <a href="index?page=task_overdue&id_goal=<?= $dataTodo['id_goal']; ?>&nm_goal=<?= $dataTodo['nm_goal']; ?>" class="btn btn-tool">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $id = $dataTodo['id_goal'];
                                $query3 = "SELECT * FROM workspace
                                JOIN todo ON todo.id_goal = workspace.id_goal WHERE todo.id_goal='$id' AND status = 'telat'";
                                $todo3 = mysqli_query($link, $query3);
                                $result3 = array();
                                while ($data3 = mysqli_fetch_assoc($todo3)) {
                                    $result3[] = $data3; //result dijadikan array 
                                }
                                foreach ($result3 as $dataTodo3) : ?>
                                    <div class="custom-control custom-checkbox text-danger">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                                        <label for="customCheckbox1_1" class="custom-control-label text-danger"><?= $dataTodo3['title']; ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h5 class="card-title"><b>Task Completed</b></h5>
                                <div class="card-tools">
                                    <a href="index?page=task_completed&id_goal=<?= $dataTodo['id_goal']; ?>&nm_goal=<?= $dataTodo['nm_goal']; ?>" class="btn btn-tool">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $id = $dataTodo['id_goal'];
                                $query4 = "SELECT * FROM workspace
                                JOIN todo ON todo.id_goal = workspace.id_goal WHERE todo.id_goal='$id' AND status = 'selesai'";
                                $todo4 = mysqli_query($link, $query4);
                                $result4 = array();
                                while ($data4 = mysqli_fetch_assoc($todo4)) {
                                    $result4[] = $data4; //result dijadikan array 
                                }
                                foreach ($result4 as $dataTodo4) : ?>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" checked disabled>
                                        <label for="customCheckbox1_1" class="custom-control-label"><s><?= $dataTodo4['title']; ?></s></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="card card-secondary card-outline">
                            <div class="card-header">
                                <h5 class="card-title">Description</h5>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>

                            </div>
                            <div class="card-body">
                                <p>
                                    <?= $dataTodo['deskripsi']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $no++; ?>
            <?php endforeach; ?>
        </div>
    </section>
</div>