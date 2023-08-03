<?php include '../unauthenticated_redirection.php'?>
<?php include '../head.php'?>

<body class="hold-transition sidebar-mini layout-fixed">
  <?php include "../nav.php" ?>
  <?php include "../aside.php" ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content">
      <div id="displayDataTable">

      </div>
      <div class="modal hide fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">

        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Post</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                <label for="number">Post Seat Number</label>
                <input type="text" class="form-control" id="updatenum" placeholder="Enter Post Number">
              </div>
              <div class="form-group">
                <label for="posttype">Post Type</label>

                <select name="post" type="text" id="updatepost" class="form-control">
                  <option value="0">0</option>
                  <option value="1">51</option>
                  <option value="2">52</option>
                  <option value="3">53</option>
                  <option value="4">54</option>
                  <option value="4">55</option>
                  <option value="4">56</option>
                  <option value="4">57</option>
                  <option value="4">58</option>
                  <option value="4">59</option>
                  <option value="4">60</option>
                  <option value="4">61</option>
                  <option value="4">62</option>
                </select>

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
        function adduser() {
          var num = $('#number').val();
          var post = $('#posttype').val();
          var desc = $('#desc').val();
          $.ajax({
            url: "add.php",
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
            $('#updatenum').val(userid.numberofseat);
            $('#updatepost').val(userid.posttype);
            $('#updatedesc').val(userid.postdescription);
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

          $.post("updatepost.php", {
            updatenum: updatenum,
            updatepost: updatepost,
            updatedesc: updatedesc,
            hiddendata: hiddendata

          }, function (data, status) {
            $('#updateModal').modal('hide');
            displayData();
          });

        }
      </script>
  </div>

  </a>
  </li>
  </ul>
  </div>
  </div>
  </div>
  </ul>

  <!-- /.card -->
  </section>


  </div>

  </div>



  </div>
  </section>
  </div>
  </section>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  </div>
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

  </script>

</body>

</html>