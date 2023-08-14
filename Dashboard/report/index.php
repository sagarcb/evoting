<?php include '../unauthenticated_redirection.php'?>
<?php
include '../../php/db.php';

/*Getting Election Title*/
$electionTitle = electionTitle($conn);

$postData = [];
$data = retrieveReportData($conn);
$finalData = [];
$candidateData = [];
$count = 1;
foreach ($data as $key => $row) {
    $postData = [
        'postid' => $row['postid'],
        'posttitle' => $row['postdescription'],
        'count' => $count
    ];
    $candidateData = [
        'candidatename' => $row['candidatename'],
        'candidateimage' => $row['candidateimage'],
        'vote_count' => $row['ballot_number_count'],
        'batch' => $row['batch']
    ];
    if ($key <= 0 || $data[$key - 1]['postid'] != $row['postid']) {
        $count = 1;
        $finalData[$row['postid']] = $postData;
    }else {
        $count++;
    }
    $finalData[$row['postid']]['candidates'][] = $candidateData;
}

foreach ($finalData as $key => $row) {
    $finalData[$key]['count'] = count($row['candidates']);
}

function electionTitle($conn) {
    $query = "SELECT * FROM `electioninfo`";
    $data = mysqli_query($conn, $query)->fetch_assoc();
    return $data['electiontitle'];
}

function retrieveReportData($conn) {
    $query = "SELECT
          p.postid,
          p.postdescription,
          c.candidatename,
          c.candidateimage,
          c.candidateid,
          c.batch,
          COALESCE(vote_count, 0) AS ballot_number_count
            FROM
              postinfo p
            LEFT JOIN
              candidateinfo c ON p.postid = c.postid
            LEFT JOIN (
              SELECT
                v.postid,
                v.candidateid,
                COUNT(v.ballotnumber) AS vote_count
              FROM
                votecastinfo v
              GROUP BY
                v.postid, v.candidateid
              ORDER BY vote_count DESC
            ) AS votes ON p.postid = votes.postid AND c.candidateid = votes.candidateid
            ORDER BY
              p.postid,ballot_number_count DESC;";

    $result = mysqli_query($conn,$query);
    if ($result) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
    return [];
}
$a = 323;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$electionTitle ? $electionTitle : 'Election Report'?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">../
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">

    <style>
        .container {
            max-width: 100% !important;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
<style>
    .content-wrapper {
        background-color: white !important;
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
        <img class="animation__shake" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <?php include '../nav.php'?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include '../aside.php'?>
</div>
<!-- /.sidebar -->

<style>
    #report-content {
        padding-left: 8%;
        padding-right: 8%;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="main-heading">
        <h1></h1>
    </div>
    <div id="report-content">
        <div style="margin-bottom: 1%">
            <button class="btn btn-primary" id="printBtn">Print</button>
        </div>
        <table class="table table-bordered text-center" id="reportTable">
            <thead>
                <tr>
                    <th style="width: 15%">Post Name</th>
                    <th>Candidate Name</th>
                    <th>Candidate Batch</th>
                    <th>Candidate Rank</th>
                    <th>Vote Count</th>
                    <th>Candidate Image</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($finalData as $key=>$row) {
                foreach ($row['candidates'] as $candidateKey => $candidate) {
                    $a = 32;
                    if ($candidateKey == 0) {
                    ?>
                    <tr>
                        <td style="width: 15%" rowspan="<?=$row['count']?>"><?=$row['posttitle']?></td>
                        <td><?=$candidate['candidatename']?></td>
                        <td><?=$candidate['batch']?></td>
                        <td><?php echo $candidateKey+1?></td>
                        <td><?=$candidate['vote_count']?></td>
                        <td style="text-align: center">
                            <?php if ($candidate['candidateimage']) { ?>
                                <img src="../candidate/candidate_images/<?=$candidate['candidateimage']?>" alt="" height="50px">
                            <?php }else { ?>
                                <img src="../candidate/candidate_images/avatar.jpg" alt="" height="50px">
                            <?php } ?>
                        </td>
                    </tr>
            <?php }else{ ?>
                        <tr>
                            <td><?=$candidate['candidatename']?></td>
                            <td><?=$candidate['batch']?></td>
                            <td><?php echo $candidateKey+1?></td>
                            <td><?=$candidate['vote_count']?></td>
                            <td style="text-align: center">
                                <?php if ($candidate['candidateimage']) { ?>
                                    <img src="../candidate/candidate_images/<?=$candidate['candidateimage']?>" alt="" height="50px">
                                <?php }else { ?>
                                    <img src="../candidate/candidate_images/avatar.jpg" alt="" height="50px">
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } }} ?>

            </tbody>
        </table>
    </div>

</div>

<?php include_once "../copyright.php"?>

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
    $(document).ready(function () {
        var printBtn = $('#printBtn');
        var table = $('#reportTable');
        $(printBtn).on('click', function () {
            var printWindow = window.open("", "Print Window");
            var tableHtml = $(table).clone();
            tableHtml.removeClass("d-print-none");
            tableHtml.addClass("d-print-block");
            tableHtml.find("button").remove();
            printWindow.document.write("<html><head><title><?=$electionTitle ? $electionTitle : 'Election Report'?></title>" +
                "<style>#reportTable, #reportTable th, #reportTable td {border: 1px solid #000 !important; text-align: center}" +
                "</style>" +
                "</head><body>" + tableHtml.prop("outerHTML") + "</body></html>");
            printWindow.document.close();
            printWindow.print();
        })
    })
</script>

</body>

</html>
