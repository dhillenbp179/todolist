<?php
require_once "../templates/navbar_user.php";

// Mengecek jumlah workspace
$cekSumWp = "SELECT * FROM workspace WHERE id_user = $cekIdUser";
$SumWp = mysqli_num_rows(mysqli_query($link, $cekSumWp));

// fungsi menghitung persentase
function cekPersen(String $status)
{
    global $link, $cekIdUser;
    $cekBagian = "SELECT * FROM workspace JOIN todo
                ON todo.id_goal = workspace.id_goal
                WHERE status = '$status' AND id_user = $cekIdUser 
                ";
    $sumBagian = mysqli_num_rows(mysqli_query($link, $cekBagian));

    $cekJumlah = "SELECT * FROM workspace JOIN todo
                ON todo.id_goal = workspace.id_goal
                WHERE id_user = $cekIdUser";
    $sumJumlah = mysqli_num_rows(mysqli_query($link, $cekJumlah));

    if ($sumJumlah == 0) {
        return 0;
    } else {
        return round($sumBagian / $sumJumlah * 100);
    }
}

// Mengecek todo yg belum

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-12 col-12">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= $SumWp; ?></h3>

                            <p>Total Workspace</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-calendar"></i>
                        </div>
                        <a href="index?page=add_workspace" class="small-box-footer">Buat Workspace dan Todo Baru <i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= cekPersen("selesai"); ?><sup style="font-size: 20px">%</sup></h3>

                            <p>Pekerjaan Telah Selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= cekPersen("belum"); ?><sup style="font-size: 20px">%</sup></h3>

                            <p>Pekerjaan Yang Akan Datang</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= cekPersen("telat"); ?><sup style="font-size: 20px">%</sup></h3>

                            <p>Pekerjaan Terlambat</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-times"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?php
require_once "../templates/footer.php";
?>