<?php


// else{
//     header("Location: ../index.php");
// }

?>










<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="/evoting/Dashboard/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
                <li><a href="../php/logout.php?logout_id=<?php error_reporting(0);
                echo $unique_id; ?>"><button class="logout_btn" style="margin-left: 700px;">Log
                            Out</button></a></li>
            </ul>



            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->






        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="dashboard.php" class="brand-link">
                <img src="/evoting/Dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Dashboard</span>
            </a>

            <!-- Sidebar -->





            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link active">
                            <i class="bi bi-caret-down-fill"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Update election info
                                        <i class="fas fa-angle-left right"></i>
                                        <span class="badge badge-info right">6</span>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <div class="modal hide fade" id="electionModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Election</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="electiontitle">Election Title</label>
                                                            <input type="text" class="form-control" id="electiontitle"
                                                                placeholder="Election Title">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="electionpass">Election Password</label>
                                                            <input type="password" class="form-control"
                                                                id="electionpass" placeholder="Election Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="electionstatus">Election Status</label>

                                                            <select name="electionstatus" type="text"
                                                                id="electionstatus" class="form-control">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="startime">Election Start Date And Time</label>
                                                            <input type="datetime-local" class="form-control"
                                                                id="starttime"
                                                                placeholder="Election start Date And Time">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="endtime">Election End Date And Time</label>
                                                            <input type="datetime-local" class="form-control"
                                                                id="endtime">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="button" class="btn btn-primary"
                                                            onclick="electiontitle();">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <button type="button" id-="btn" class="sidebar-dark-primary"
                                                style="margin-left:10px;border:none;color:white;" data-toggle="modal"
                                                data-target="#electionModal"><i class="far fa-circle nav-icon"></i>
                                                Election Title
                                            </button>
                                        </div>
                                        <style>
                                            #electionModal {
                                                margin-left: 80px;

                                            }

                                            #updatevotermodal {
                                                margin-left: 80px;
                                            }

                                            .modal-content {
                                                border: 1px solid blue;
                                                width: 600px;

                                            }

                                            .modal-backdrop {
                                                position: inherit !important;

                                            }

                                            .modal-body .form-group textarea {
                                                height: 150px;
                                            }
                                        </style>
                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>

                                            $(document).ready(function () {
                                                electiondisplay();
                                            });
                                            function electiondisplay() {
                                                var  electiondisplay = "true";
                                                $.ajax({
                                                    url: "viewelection.php",
                                                    type: 'post',
                                                    data: {
                                                        electiondisplay: electiondisplay
                                                    },
                                                    success: function (data, status) {
                                                        $("#electiondisplay").html(data);
                                                    }
                                                });
                                            }
                                            function electiontitle() {
                                                var electiontitle = $('#electiontitle').val();
                                                var electionpass = $('#electionpass').val();
                                                var electionstatus = $('#electionstatus').val();
                                                var starttime = $('#starttime').val();
                                                var endtime = $('#endtime').val();
                                                $.ajax({
                                                    url: "php/addelection.php",
                                                    type: 'post',
                                                    data: {
                                                        electiontitle: electiontitle,
                                                        electionpass: electionpass,
                                                        electionstatus: electionstatus,
                                                        starttime: starttime,
                                                        endtime: endtime
                                                    },
                                                    success: function (data, status) {
                                                        $('#electionModal').modal('hide');
                                                        electiondisplay();
                                                    }
                                                });

                                            };
                                        </script>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-chart-pie"></i>
                                    <p>
                                        Manage voter
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <div class="modal hide fade" id="votermodal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Voter
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="name">Voter Name</label>
                                                            <input type="text" class="form-control" id="votername"
                                                                placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="mail">Voter Email</label>
                                                            <input type="email" class="form-control" id="voteremail"
                                                                placeholder="Voter Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="voterpass">Voter Password</label>
                                                            <input type="password" class="form-control" id="voterpass"
                                                                placeholder="Voter Password">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="voterbatch">Voter Batch</label>
                                                            <select name="post" type="text" id="voterbatch"
                                                                class="form-control">
                                                                <option value="0">0</option>
                                                                <option value="1">51</option>
                                                                <option value="2">52</option>
                                                                <option value="3">53</option>
                                                                <option value="4">54</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="button" class="btn btn-primary"
                                                            onclick="addvoter();">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <button type="button" id-="btn" class="sidebar-dark-primary"
                                                style="margin-left:10px;border:none;color:white;" data-toggle="modal"
                                                data-target="#votermodal"><i class="far fa-circle nav-icon"></i>
                                                Add Voter
                                            </button>


                                        </div>
                                        <style>
                                            #votermodal {
                                                margin-left: 80px;

                                            }

                                            #updatevotermodal {
                                                margin-left: 80px;
                                            }

                                            .modal-content {
                                                border: 1px solid blue;
                                                width: 600px;

                                            }

                                            .modal-backdrop {
                                                position: inherit !important;

                                            }

                                            .modal-body .form-group textarea {
                                                height: 150px;
                                            }
                                        </style>
                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {
                                                displayVoter();
                                            });
                                            function displayVoter() {
                                                var displayVoter = "true";
                                                $.ajax({
                                                    url: "voterview.php",
                                                    type: 'post',
                                                    data: {
                                                        voterdisplay: displayVoter
                                                    },
                                                    success: function (data, status) {
                                                        $("#displayVoter").html(data);
                                                    }
                                                });
                                            }
                                            function addvoter() {
                                                var votername = $('#votername').val();
                                                var voteremail = $('#voteremail').val();
                                                var voterpass = $('#voterpass').val();
                                                var voterbatch = $('#voterbatch').val();
                                                $.ajax({
                                                    url: "php/voteradd.php",
                                                    type: 'post',
                                                    data: {
                                                        voternameSend: votername,
                                                        voteremailSend: voteremail,
                                                        voterpassSend: voterpass,
                                                        voterbatchSend: voterbatch,
                                                    },
                                                    success: function (data, status) {
                                                        $('#votermodal').modal('hide');
                                                        displayVoter();
                                                    }
                                                });

                                            };
                                        </script>
                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/charts/flot.html" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add Bulk</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../voterinfo/Voterlist.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>View list</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tree"></i>
                                    <p>
                                        Manage Post
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <!-- Button trigger modal -->


                                        <!-- Modal -->


                                        <div class="modal hide fade" id="completeModal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">

                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="number">Post Seat Number</label>
                                                            <input type="text" class="form-control" id="number"
                                                                placeholder="Enter Post Number">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="posttype">Post Type</label>

                                                            <select name="post" type="text" id="posttype"
                                                                class="form-control">
                                                                <option value="0">0</option>
                                                                <option value="1">51</option>
                                                                <option value="2">52</option>
                                                                <option value="3">53</option>
                                                                <option value="4">54</option>
                                                            </select>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="desc">Post Description</label>
                                                            <textarea name="desc" form="" type="text"
                                                                class="form-control" id="desc"
                                                                placeholder="Write Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="button" class="btn btn-primary"
                                                            onclick="adduser();">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <button type="button" id-="btn" class="sidebar-dark-primary"
                                                style="margin-left:10px;border:none;color:white;" data-toggle="modal"
                                                data-target="#completeModal"><i class="far fa-circle nav-icon"></i>
                                                Add post
                                            </button>


                                        </div>
                                        <style>
                                            #completeModal {
                                                margin-left: 80px;

                                            }

                                            #Modal {
                                                margin-left: 80px;
                                            }

                                            .modal-content {
                                                border: 1px solid blue;
                                                width: 600px;

                                            }

                                            .modal-backdrop {
                                                position: inherit !important;

                                            }

                                            .modal-body .form-group textarea {
                                                height: 150px;
                                            }
                                        </style>
                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                        <script>
                                            $(document).ready(function () {
                                                displayData();
                                            });
                                            function displayData() {
                                                var displayData = "true";
                                                $.ajax({
                                                    url: "../postinfo/fetchpost.php",
                                                    type: 'post',
                                                    data: {
                                                        displaySend: displayData
                                                    },
                                                    success: function (data, status) {
                                                        $("#displayDataTable").html(data);
                                                    }
                                                });
                                            }
                                            function adduser() {
                                                var num = $('#number').val();
                                                var post = $('#posttype').val();
                                                var desc = $('#desc').val();
                                                $.ajax({
                                                    url: "../postinfo/add.php",
                                                    type: 'post',
                                                    data: {
                                                        numSend: num,
                                                        postSend: post,
                                                        descSend: desc,
                                                    },
                                                    success: function (data, status) {
                                                        $('#completeModal').modal('hide');
                                                        displayData();
                                                    }
                                                });

                                            };

                                        </script>

                                    </li>
                                    <li class="nav-item">
                                        <a href="../postinfo/viewpost.php" class="nav-link">
                                            <div class="container" class="sidebar-dark-primary"
                                                style="margin-left:0px;border:none;color:white;">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>View Post List</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        Manage Candidate
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <div class="modal hide fade" id="Modal" tabindex="-1" role="dialog"
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
                                                    <div class="modal-body">

                                                        <div class="form-group">
                                                            <label for="Name">Candidate Name</label>
                                                            <input type="text" class="form-control" id="Name"
                                                                placeholder="Enter Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Candidate Email</label>
                                                            <input type="email" class="form-control" id="email"
                                                                placeholder="Enter Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="batch">Candidate Batch</label>
                                                            <input type="text" class="form-control" id="batch"
                                                                placeholder="Enter Batch">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="post">Post Type</label>

                                                            <select name="post" type="text" id="post"
                                                                class="form-control">
                                                                <option value="0">0</option>
                                                                <option value="1">51</option>
                                                                <option value="2">52</option>
                                                                <option value="3">53</option>
                                                                <option value="4">54</option>
                                                            </select>

                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label for="img">Candidate Image</label>
                                                            <div>
                                                                <input type="file" id="img" name="image">
                                                            </div>

                                                        </div> -->
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" name="button" class="btn btn-primary"
                                                            onclick="addcandidate();">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="container">
                                            <button type="button" id-="btn" class="sidebar-dark-primary"
                                                style="margin-left:10px;border:none;color:white;" data-toggle="modal"
                                                data-target="#Modal"><i class="far fa-circle nav-icon"></i>
                                                Add Candidate
                                            </button>


                                        </div>

                                        <script
                                            src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                                        <script>
                                            function addcandidate() {
                                                var name = $('#Name').val();
                                                var email = $('#email').val();
                                                var batch = $('#batch').val();
                                                var post = $('#post').val();
                                                $.ajax({
                                                    url: "php/candidateadd.php",
                                                    type: 'post',
                                                    data: {
                                                        nameSend: name,
                                                        emailSend: email,
                                                        batchSend: batch,
                                                        posttSend: post
                                                    },
                                                    success: function (data, status) {
                                                        // $('#Modal').modal('hide');
                                                        console.log(status);
                                                    }
                                                });
                                            };

                                        </script>





                                    </li>
                                    <li class="nav-item">
                                        <a href="pages/forms/advanced.html" class="nav-link">
                                            <div class="container" class="sidebar-dark-primary"
                                                style="margin-left:0px;border:none;color:white;">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>View Candiate List</p>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="pages/calendar.html" class="nav-link">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        View Result
                                        <span class="badge badge-info right">2</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="pages/calendar.html" class="nav-link">
                                    <i class="nav-icon far fa-calendar-alt"></i>
                                    <p>
                                        Reset Data
                                        <span class="badge badge-info right">2</span>
                                    </p>
                                </a>
                            </li>


                            <ul class="nav nav-treeview">






                            </ul>
                    </li>



























                </ul>
            </nav>
            <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="background-image:url(img/dashbg.jpg);background-position:center;
    background-size:calc(900px);background-repeat:no-repeat;">
        <style>
            .content-wrapper {
                background-color: white !important;
            }
        </style>
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
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>New Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53<sup style="font-size: 20px">%</sup></h3>

                                <p>Bounce Rate</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>User Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <div id="electiondisplay">

            </div>
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
    <!-- finish -->

    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    </script>

</body>

</html>
