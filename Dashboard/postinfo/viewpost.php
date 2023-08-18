<?php include '../unauthenticated_redirection.php'?>
<?php include '../head.php'?>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include "../nav.php" ?>
  <?php include "../aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <section class="content-wrapper">
    <section class="content">
      <div id="displayDataTable" style="margin-bottom: 20px">

      </div>
      <div class="modal hide fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
          <div class="modal-content" style="height: 620px">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                  <label for="updatenum">Post Seat Number</label>
                  <select class="form-control" id="updatenum">
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
                  <label for="updatepost">Post Type</label>
                  <input type="number" name="posttype" id="updatepost" class="form-control">
              </div>
                <div class="form-group">
                    <label for="update_multiple_person">Number of Select Person</label>
                    <input type="number" name="multiple_person" id="update_multiple_person" class="form-control" value="0">
                </div>
              <div class="form-group">
                <label for="desc">Post Description</label>
                <textarea name="desc" form="" type="text" class="form-control" id="updatedesc"
                  placeholder="Write Description"></textarea>
              </div>
            </div>
            <div class="modal-footer">

              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" name="button" class="btn btn-primary" onclick="updateDetails()">Update</button>
              <input type="hidden" id="hiddendata">
            </div>
          </div>
        </div>
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
          height: 596px;

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
            url: "fetchpost.php",
            type: 'post',
            data: {
              displaySend: displayData
            },
            success: function (data, status) {
              $("#displayDataTable").html(data);
            }
          });
        }
        // function adduser() {
        //   var num = $('#number').val();
        //   var post = $('#posttype').val();
        //   var desc = $('#desc').val();
        //   $.ajax({
        //     url: "add.php",
        //     type: 'post',
        //     data: {
        //       numSend: num,
        //       postSend: post,
        //       descSend: desc,
        //     },
        //     success: function (data, status) {
        //       $('#completeModal').modal('hide');
        //       displayData();
        //     }
        //   });
        //
        // };
        //delete//
        function DeleteUser(deleteid) {
          $.ajax({
            url: "delete.php",
            type: 'post',
            data: {
              deletesend: deleteid
            },
            success: function (data, status) {
              displayData();
            }
          });
        }

        function GetDetails(updateid) {
          $('#hiddendata').val(updateid);
          $.post("updatepost.php", { updateid: updateid }, function (data, status) {
            var userid = JSON.parse(data);
            console.log(userid);
            $('#updatenum').val(userid.numberofseat);
            $('#updatepost').val(userid.posttype);
            $('#updatedesc').val(userid.postdescription);
            $('#update_multiple_person').val(userid.multiple_person)
            // console.log(status);
          });

          $('#updateModal').modal("show");

        }
        // update evente
        function updateDetails() {
          var updatenum = $('#updatenum').val();
          var updatepost = $('#updatepost').val();
          var updatedesc = $('#updatedesc').val();
          var hiddendata = $('#hiddendata').val();
          var multiple_person = $('#update_multiple_person').val();

          $.post("updatepost.php", {
            updatenum: updatenum,
            updatepost: updatepost,
            updatedesc: updatedesc,
            hiddendata: hiddendata,
            multiple_person: multiple_person
          }, function (data, status) {
            $('#updateModal').modal('hide');
            displayData();
          });

        }
      </script>
  <!-- /.card -->
  </section>
  </section>
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

</body>

</html>
