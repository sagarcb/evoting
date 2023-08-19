<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../dashboard.php" class="brand-link">
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
                                        height: 590px;

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
                                            url: "../electioninfo/addelection.php",
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
                            </li>
                            <li class="nav-item">
                                <div class="container">

                                    <button type="button" id-="btn" class="sidebar-dark-primary"
                                        style="margin-left:9.5px;border:none;color:white;margin-top:10px"
                                        data-toggle="modal" data-target="#bulk"><i class="far fa-circle nav-icon"></i>
                                        Add Bulk
                                    </button>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="Voterlist.php" class="nav-link">
                                    <div class="container" class="sidebar-dark-primary"
                                        style="margin-left:-1px;border:none;color:white;margin-top:-0px;">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>view voter list</p>
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
                                        <div class="modal-content" >
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

                                                    <select name="post" type="text" id="posttype" class="form-control">
                                                        <option value="0">0</option>
                                                        <option value="1">51</option>
                                                        <option value="2">52</option>
                                                        <option value="3">53</option>
                                                        <option value="4">54</option>
                                                    </select>

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

                                                    <select name="post" type="text" id="post" class="form-control">
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
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
