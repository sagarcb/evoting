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
        <img class="animation__shake" src="/evoting/Dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
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
    textarea[disabled] {
        background-color: inherit;
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
                    <th>Vote Count</th>
                    <th>Candidate Image</th>
                    <th>Remarks</th>
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
                        <td><?=$candidate['vote_count']?></td>
                        <td style="text-align: center">
                            <?php if ($candidate['candidateimage']) { ?>
                                <img src="../candidate/candidate_images/<?=$candidate['candidateimage']?>" alt="" height="50px">
                            <?php }else { ?>
                                <img src="../candidate/candidate_images/avatar.jpg" alt="" height="50px">
                            <?php } ?>
                        </td>
                        <td><textarea name="" id="" cols="15" rows="5" style="border: none; outline: none; resize: none;" disabled></textarea></td>
                    </tr>
            <?php }else{ ?>
                        <tr>
                            <td><?=$candidate['candidatename']?></td>
                            <td><?=$candidate['batch']?></td>
                            <td><?=$candidate['vote_count']?></td>
                            <td style="text-align: center">
                                <?php if ($candidate['candidateimage']) { ?>
                                    <img src="../candidate/candidate_images/<?=$candidate['candidateimage']?>" alt="" height="50px">
                                <?php }else { ?>
                                    <img src="../candidate/candidate_images/avatar.jpg" alt="" height="50px">
                                <?php } ?>
                            </td>
                            <td><textarea name="" id="" cols="15" rows="5" style="border: none; outline: none; resize: none;" disabled></textarea></td>
                        </tr>
                    <?php } }} ?>

            </tbody>
        </table>
    </div>

</div>

<?php include_once "../copyright.php"?>




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
            var printWindow = window.open("", "Print_Window");
            var tableHtml = $(table).clone();
            tableHtml.removeClass("d-print-none");
            tableHtml.addClass("d-print-block");
            tableHtml.find("button").remove();
            tableHtml.find("tr").css("page-break-inside", "avoid");
            printWindow.document.write("<html><head><title>Election Report</title>" +
                "<style>" +
                "table {border-collapse: collapse;border: 1px solid black; text-align: center;}" +
                "th, td {border: 1px solid black; padding: 5px}" +
                "td:nth-child(1) {border-right: none;}"+
                "head title {display: none}" +
                "textarea[disabled] {background-color: inherit;}"+
                "</style>" +
                "</head><body>" +
                "<h2 style='text-align: center'><?=$electionTitle? $electionTitle . ' Report' : 'Election Report'?></h2>"+
                "<div class='logo'>" +
                "<img src='../../img/logo.jpg' style='height: 5%'>"+
                "</div>" +
                tableHtml.prop("outerHTML") +
                "<div class='footer'><div class='left-signature'><p><hr>Election Commissioner</p></div>" +
                "<div class='right-signature'>"+
                "<p style='color: black; font-weight: bold'><hr style='margin-top: -4%; background: black'></p></div></div>"+
                "<style>" +
                "html, body {margin: 0;padding: 0;height: 100%;}"+
                ".footer {bottom: 0;width: 100%;background-color: #ffffff;display: flex;"+
                "justify-content: space-between;align-items: center;padding: 10px 0;margin-top: 6%;}"+
                ".left-signature, .right-signature {flex: 1;text-align: left;padding-left: 20px;}"+
                ".right-signature {text-align: right;padding-right: 20px;}"+
                ".left-signature hr {width: 60%; margin-left: 0} .right-signature hr {width: 60%; margin-right: 0}"+
                ".logo {top: 0;right: 0;margin: 20px;width: 100px;}"+
                "</style>"+
                "</body></html>");
            printWindow.document.close();
            printWindow.onload = function() {
                printWindow.print();
            };
        })
    })
</script>

</body>

</html>
