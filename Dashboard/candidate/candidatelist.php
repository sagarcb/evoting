<?php include '../unauthenticated_redirection.php'?>
<?php
include '../../php/db.php';

$postData = [];

$query = "SELECT * FROM `postinfo`";

$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $postData[] = $row;
}

function showTwoWordPostDescription($desc) {
    $words = explode(" ", $desc);
    $limitedWords = array_slice($words, 0, 2);
    return implode(" ", $limitedWords);
}
?>
<?php include '../head.php'?>

<body class="hold-transition sidebar-mini layout-fixed">
<style>
    .content-wrapper {
        background-color: white !important;
    }
    .header-btn-section {
        margin-left: 10px;
        margin-top: 10px;
        margin-bottom: 5px;
    }
    .image-container {
        width: 60px;
        height: 60px;
        overflow: hidden;
        border-radius: 50%; /* Make it a circle */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3); /* Add a subtle shadow */
    }

    /* Style for the image */
    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Make the image cover the container */
    }
</style>
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="/evoting/Dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include '../nav.php'?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include '../aside.php'?>
</div>
<!-- /.sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="header-btn-section">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCandidateModal" id="topAddCandidateButton">Add Candidate</button>
    </div>


    <div id="displaycandidate" style="margin-bottom: 20px">

    </div>
</div>
<?php include "../copyright.php"?>

<div class="modal hide fade" id="addCandidateModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Candidate
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="addCandidateForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="alert alert-danger errorMsgContainer" role="alert" style="display: none">
                    </div>
                    <div class="form-group">
                        <label for="Name">Candidate Name</label>
                        <input type="text" class="form-control" id="Name"
                               placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Candidate Email</label>
                        <input type="email" class="form-control" id="email"
                               placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="batch">Candidate Batch</label>
                        <input type="text" class="form-control" id="batch"
                               placeholder="Enter Batch" required>
                    </div>
                    <div class="form-group">
                        <label for="candidateImage">Candidate Image</label>
                        <input type="file" class="form-control" id="candidateImage">
                    </div>
                    <div class="form-group">
                        <label for="post">Posts</label>

                        <select name="post" type="text" id="post"
                                class="form-control" required>
                            <?php foreach ($postData as $row) { ?>
                                <option value="<?=$row['postid']?>"><?=showTwoWordPostDescription($row['postdescription'])?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-primary" id="addCandidateBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal hide fade" id="updateCandidateModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Candidate</h5>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="updateCandidateForm">
                <div class="modal-body">
                    <div class="alert alert-danger errorMsgContainer" role="alert" style="display: none">
                    </div>
                    <input type="text" name="candidateid" id="candidateIdField" value="" hidden>
                    <div class="form-group">
                        <label for="Name">Candidate Name</label>
                        <input type="text" class="form-control" name="candidateName" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Candidate Email</label>
                        <input type="email" class="form-control" name="candidateEmail" placeholder="Enter Email" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="batch">Candidate Batch</label>
                        <input type="text" class="form-control" name="candidateBatch" placeholder="Enter Batch" required>
                    </div>
                    <div class="form-group">
                        <label for="updateCandidateImage">Candidate Image</label>
                        <input type="file" name="image" class="form-control" id="updateCandidateImage">
                    </div>
                    <div class="form-group">
                        <label for="post">Posts</label>

                        <select type="text" name="candidatePosts" class="form-control" required>
                            <?php foreach ($postData as $row) { ?>
                                <option value="<?=$row['postid']?>"><?=showTwoWordPostDescription($row['postdescription'])?></option>
                            <?php } ?>
                        </select>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="button" class="btn btn-primary" id="storeUpdateCandidateBtn">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="loader" class="hidden">
    <div class="loader-content">
        <span>Please wait...</span>
    </div>
</div>
<style>
    #loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .loader-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 4px;
    }

    .hidden {
        display: none !important;
    }
</style>




<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
<script src="../../js/manual_code.js"></script>

<script>

</script>

</body>

</html>
