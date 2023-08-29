<?php
include "./php/db.php";

$votersCount = 0;
$candidateCount = 0;
$postCount = 0;

$voterCountQuery = "SELECT COUNT(*) FROM `voterinfo`;";
$voterResult = $conn->query($voterCountQuery);

if ($voterResult->num_rows > 0) {
    $row1 = $voterResult->fetch_assoc();
    $votersCount = $row1["COUNT(*)"];
}

$candidateCountQuery = "SELECT COUNT(*) FROM `candidateinfo`;";
$candidateResult = $conn->query($candidateCountQuery);
if ($candidateResult->num_rows > 0) {
    $row2 = $candidateResult->fetch_assoc();
    $candidateCount = $row2["COUNT(*)"];
}

$postCountQuery = "SELECT COUNT(*) FROM `postinfo`;";
$postResult = $conn->query($postCountQuery);
if ($postResult->num_rows > 0) {
    $row3 = $postResult->fetch_assoc();
    $postCount = $row3["COUNT(*)"];
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-image:url(img/dashbg.png);background-position:center;
    background-size:calc(900px);background-repeat:no-repeat;">
    <style>
        .content-wrapper {
            background-color: white !important;
        }
    </style>
    <!-- Content Header (Page header) -->
    <div class="content-header">

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (isset($_SESSION['success_msg'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong><?=$_SESSION['success_msg']?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php } ?>

                        <?php if (isset($_SESSION['error_msg'])) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><?=$_SESSION['error_msg']?></strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?=$votersCount?></h3>

                                <p>Voter Info</p>
                            </div>
                            <div class="icon">
                                <i class="gg-eye-alt"></i>
                            </div>
                            <a href="/evoting/Dashboard/voterinfo/Voterlist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?=$candidateCount?></h3>

                                <p>Candidate Info</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="/evoting/Dashboard/candidate/candidatelist.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?=$postCount?></h3>

                                <p>Post Info</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="/evoting/Dashboard/postinfo/viewpost.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><img src="https://cdn-icons-png.flaticon.com/512/5191/5191745.png" height="37" width="50" alt=""></h3>

                                <p>View Result</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="/evoting/Dashboard/report/index.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

                </a>
                </li>
                <!-- End Contact Item -->
                </ul>
                <!-- /.contacts-list -->
            </div>
            <!-- /.direct-chat-pane -->
    </div>
    <!-- /.card-body -->

    <!-- /.card-footer-->
</div>
<!--/.direct-chat -->

<!-- TO DO List -->
</ul>

<!-- /.card -->
</section>
<!-- /.Left col -->
<!-- right col (We are only adding the ID to make the widgets sortable)-->


<!-- Map card -->

<!-- /.card -->

<!-- solid sales graph -->

<!-- /.card -->

<!-- Calendar -->


</div>
<!-- /. tools -->
</div>
<!-- /.card-header -->

<!-- /.card-body -->
</div>
<!-- /.card -->
</section>
<!-- right col -->
</div>
<!-- /.row (main row) -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>

<?php
unset($_SESSION['success_msg']);
unset($_SESSION['error_msg']);
?>
