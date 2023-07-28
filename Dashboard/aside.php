<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/evoting/Dashboard/dashboard.php" class="brand-link">
        <img src="/evoting/Dashboard/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
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
                                                    <input type="password" class="form-control" id="electionpass"
                                                        placeholder="Election Password">
                                                </div>

                                                <div class="form-group">
                                                    <label for="electionstatus">Election Status</label>

                                                    <select name="electionstatus" type="text" id="electionstatus"
                                                        class="form-control">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <label for="startime">Election Start Date And Time</label>
                                                    <input type="datetime-local" class="form-control" id="starttime"
                                                        placeholder="Election start Date And Time">
                                                </div>
                                                <div class="form-group">
                                                    <label for="endtime">Election End Date And Time</label>
                                                    <input type="datetime-local" class="form-control" id="endtime">
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
                                </style>
                                <script
                                    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>
                                    function electiontitle() {
                                        var electiontitle = $('#electiontitle').val();
                                        var electionpass = $('#electionpass').val();
                                        var electionstatus = $('#electionstatus').val();
                                        var starttime = $('#starttime').val();
                                        var endtime = $('#endtime').val();
                                        $.ajax({
                                            url: "/evoting/Dashboard/electioninfo/addelection.php",
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
                                                // electiondisplay();
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
                                            <div class="alert alert-danger addVoterErrMsgContainer" role="alert" style="display: none">
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
                                                    <input type="text" class="form-control" id="voterbatch"
                                                        placeholder="Voter Batch">
                                                </div>

                                                <div class="form-group">
                                                    <label for="voterStudentId">Student ID</label>
                                                    <input type="text" class="form-control" id="voterStudentId" placeholder="Student ID">
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
                                            url: "/evoting/Dashboard/voterinfo/voterview.php",
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
                                        var voterStudentId = $('#voterStudentId').val();
                                        $.ajax({
                                            url: "/evoting/Dashboard/voterinfo/voteradd.php",
                                            type: 'post',
                                            data: {
                                                voternameSend: votername,
                                                voteremailSend: voteremail,
                                                voterpassSend: voterpass,
                                                voterbatchSend: voterbatch,
                                                student_id: voterStudentId
                                            },
                                            success: function (data, status) {
                                                let res = JSON.parse(data);
                                                if (res.status) {
                                                    $('#votermodal').modal('hide');
                                                    displayVoter();
                                                }else {
                                                    $('.addVoterErrMsgContainer').show();
                                                    $('.addVoterErrMsgContainer').text(res.msg);
                                                }
                                            }
                                        });

                                    };
                                </script>
                            </li>
                            <li class="nav-item">
                                <div class="modal hide fade" id="bulkVoterModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="height: 300px">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Bulk Voters List</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/evoting/Dashboard/voterinfo/uploadBulkVoter.php" id="uploadVoterExcelFileForm" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="name">Upload Excel File</label>
                                                        <input type="file" class="form-control" name="bulkExcelFile" id="voterListExcelFile"
                                                               placeholder="Upload Excel File" required>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" name="button" class="btn btn-primary" id="uploadBulkVoterBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <button type="button" id="btn" class="sidebar-dark-primary"
                                        style="margin-left:9.5px;border:none;color:white;margin-top:10px"
                                        data-toggle="modal" data-target="#bulkVoterModal"><i class="far fa-circle nav-icon"></i>
                                        Add Bulk
                                    </button>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="/evoting/Dashboard/voterinfo/Voterlist.php" class="nav-link">
                                    <div class="container sidebar-dark-primary"
                                        style="margin-left:-1px;border:none;color:white;margin-top:-0px;">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Voter List</p>
                                    </div>
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
<!--                                                    <input type="text" class="form-control" id="number"-->
<!--                                                        placeholder="Enter Post Number">-->
                                                    <select class="form-control" id="number">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="posttype">Post Type</label>
                                                    <input type="number" name="posttype" id="posttype" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="desc">Post Description</label>
                                                    <textarea name="desc" form="" type="text" class="form-control"
                                                        id="desc" placeholder="Write Description"></textarea>
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


                                    .modal-backdrop {
                                        position: inherit !important;

                                    }

                                    .modal-body .form-group textarea {
                                        height: 150px;
                                    }
                                </style>
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                <script>
                                    $(document).ready(function () {
                                        displayData();
                                    });
                                    function displayData() {
                                        var displayData = "true";
                                        $.ajax({
                                            url: "/evoting/Dashboard/postinfo/fetchpost.php",
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
                                            url: "/evoting/Dashboard/postinfo/add.php",
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
                                <a href="/evoting/Dashboard/postinfo/viewpost.php" class="nav-link">
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
                                <a href="/evoting/Dashboard/candidate/candidatelist.php" class="nav-link">
                                    <div class="container" class="sidebar-dark-primary"
                                        style="margin-left:0px;border:none;color:white;">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Candidate List</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a href="pages/calendar.html" class="nav-link">-->
<!--                            <i class="nav-icon far fa-calendar-alt"></i>-->
<!--                            <p>-->
<!--                                View Result-->
<!--                                <span class="badge badge-info right">2</span>-->
<!--                            </p>-->
<!--                        </a>-->
<!--                    </li>-->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Reset Data
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link" data-target="#singleVoteCastModal" data-toggle="modal">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Single Vote Cast</p>
                                    </div>
                                </a>
                                <div class="modal hide fade" id="singleVoteCastModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="height: auto">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Reset Single Vote Cast</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="/evoting/Dashboard/reset/reset_single_vote_cast.php" method="post" id="resetSingleVoteCastForm">
                                                <div class="modal-body">
                                                    <div class="form-group row">
                                                        <label for="inputBallotNo" class="col-sm-4 col-form-label">Enter Ballot No.</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="ballot_no" class="form-control" id="inputBallotNo" placeholder="Ballot No.">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputVoterId" class="col-sm-4 col-form-label">Enter Voter ID</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" name="voter_id" class="form-control" id="inputVoterId" placeholder="Voter ID">
                                                        </div>
                                                    </div>
                                                    <p style="color: red; text-align: center; display: none" id="singleVoteCastErrMsg">* Ballot No. field or Voter ID field cannot be empty.</p>
                                                </div>
                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    <button type="button" id="resetSingleVoteCastBtn" name="button" class="btn btn-primary">Reset</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="resetAllCastedVoteBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset All Casted Vote</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="candidateResetBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Candidate</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="resetPostBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Post</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="resetVoterBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Voter</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="deleteVoterBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Delete Voter</p>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="resetElectionBtn">
                                    <div class="container sidebar-dark-primary">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reset Election</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    $(document).ready(function () {
        /*Upload bulk voter list functionalities*/
        var uploadBulkVoterBtn = $('#uploadBulkVoterBtn');
        var uploadBulkVoterForm = $('#uploadVoterExcelFileForm');

        var loader = $('#loader');
        $(uploadBulkVoterBtn).on('click', function () {
            uploadBulkVoter();
        });
        function uploadBulkVoter() {
            $(uploadBulkVoterForm).submit();
        }

        function displayCandidate() {
            var displayCandidate = "true";
            $.ajax({
                url: "candidateview.php",
                type: 'post',
                data: {
                    candidateDisplay: displayCandidate
                },
                success: function (data, status) {
                    $("#displaycandidate").html(data);
                }
            });
        }
    })
</script>

<script src="/evoting/js/reset-data.js"></script>