<?php
include 'db.php';
if (isset($_POST['electiondisplay'])) {
    $table = '<table class="table">
  <thead>
    <tr>
      <th scope="col">Election Title</th>
      <th scope="col">Election Password</th>
      <th scope="col">Election Status</th>
      <th scope="col">Start Date And Time</th>
      <th scope="col">End Date And Time</th>
       <th scope="col">Action</th>
        
    </tr>
  </thead>';
    $sql = "select * from `electioninfo`";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['electiontitle'];
        $password = $row['electionpassword'];
        $status = $row['electionstatus'];
        $start = $row['electionstartdatetime'];
        $end = $row['electionenddatetime'];
        $table .= '<tr>
      <td scope="row">' . $id . '</td>
      <td>' . $password . '</td>
      <td>' .  $status . '</td>
      <td>' .  $start . '</td>
      <td>' .  $end . '</td>
      <td>
    <button class="btn btn-dark" onclick="GetDetails(' . $id . ')">Update</button>
    <button class="btn btn-danger"onclick="DeleteUser(' . $id . ')">Delete</button>
</td>
    </tr>';
        
    }
    $table .= '</table>';
    echo $table;
}


?>