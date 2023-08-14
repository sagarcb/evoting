<?php include '../unauthenticated_redirection.php'?>
<?php include '../head.php'?>

<body class="hold-transition sidebar-mini layout-fixed">

    <!-- /.navbar -->
    <?php include "../nav.php" ?>
    <?php include "../aside.php" ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <div class="container">
            <div id="displayVoter">

            </div>
            <div class="modal hide fade" id="updatevotermodal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="alert alert-danger voterErrMsgContainer" role="alert" style="display: none">
                        </div>
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Voter
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <label for="name">Voter Name</label>
                                <input type="text" class="form-control" id="updatevotername" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="mail">Voter Email</label>
                                <input type="email" class="form-control" id="updatevoteremail"
                                    placeholder="Voter Email">
                            </div>
                            <div class="form-group">
                                <label for="voterpass">Voter Password</label>
                                <input type="password" class="form-control" id="updatevoterpass"
                                    placeholder="Voter Password">
                            </div>

                            <div class="form-group">
                                <label for="updatevoterbatch">Voter Batch</label>
                                <input type="text" class="form-control" id="updatevoterbatch" placeholder="Voter Batch">
                            </div>

                            <div class="form-group">
                                <label for="updateVoterId">Student ID</label>
                                <input type="text" class="form-control" id="updateVoterId" placeholder="Student ID">
                            </div>

                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" name="button" class="btn btn-primary"
                                    onclick="updatevoterdetails()">Update</button>
                                <input type="hidden" id="voterhiddendata">
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    function voteredit(voterupdateid) {
                        $('#voterhiddendata').val(voterupdateid);
                        $.ajax({
                            type: 'post',
                            url: '/evoting/Dashboard/voterinfo/updatevoter.php',
                            data: {
                                vupdateid: voterupdateid
                            },
                            success: function (res) {
                                let response = JSON.parse(res);
                                console.log(response);
                                if (response.status) {
                                    updateVoterModal(response);
                                    $('#updatevotermodal').modal("show");
                                }else {
                                    alert('Something went wrong? Please reload the page and try again.');
                                }
                            },
                            error: function (error) {
                                alert('Something went wrong. Please try again.');
                            }
                        })
                        function updateVoterModal(data) {
                            $('#updatevotername').val(data.votername);
                            $('#updatevoteremail').val(data.email);
                            $('#updatevoterpass').val(data.password);
                            $('#updatevoterbatch').val(data.batch);
                            $('#updateVoterId').val(data.student_id)
                        }

                    }
                    function updatevoterdetails() {
                        var updatename = $('#updatevotername').val();
                        var updateemail = $('#updatevoteremail').val();
                        var updatepass = $('#updatevoterpass').val();
                        var updatebatch = $('#updatevoterbatch').val();
                        var voterhiddendata = $('#voterhiddendata').val();
                        var student_id = $('#updateVoterId').val();

                        $.post("/evoting/Dashboard/voterinfo/updatevoter.php", {
                            updatename: updatename,
                            updateemail: updateemail,
                            updatepass: updatepass,
                            updatebatch: updatebatch,
                            voterhiddendata: voterhiddendata,
                            student_id: student_id
                        }, function (data, status) {
                            $('#updatevotermodal').modal('hide');
                            displayVoter();
                        });

                    }

                    function deletevoter(voterdeleteid) {
                        $.ajax({
                            url: "/evoting/Dashboard/voterinfo/deletevoter.php",
                            type: 'post',
                            data: {
                                voterdeletesend: voterdeleteid
                            },
                            success: function (data, status) {
                                displayVoter();

                            }
                        });
                    }

                </script>
            </div>

        </div>
    </div>

    <?php include_once "../copyright.php"?>

    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/chart.js/Chart.min.js"></script>
    <script src="../plugins/sparklines/sparkline.js"></script>
    <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="../plugins/moment/moment.min.js"></script>
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../dist/js/adminlte.js"></script>
    <script src="../dist/js/demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="../../js/manual_code.js"></script>

    </script>

</body>

</html>
