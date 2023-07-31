<?php
include 'db.php';
if (isset($_POST['voterdisplay'])) {
    $table = '<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial Number</th>
      <th scope="col">Voter Name</th>
      <th scope="col">Voter Email</th>
      <th scope="col">Voter Batch</th>
      <th scope="col">Student ID</th>
       <th scope="col">Action</th>
        
    </tr>
  </thead>';
    $sql = "select * from `voterinfo` ORDER BY serial ASC;";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['voterid'];
        $voteremail = $row['email'];
        $votername = $row['votername'];
        $voterbatch = $row['batch'];
        $table .= '<tr>
      <td scope="row">' . $row['serial'] . '</td>
      <td>' . $votername . '</td>
      <td>' . $voteremail . '</td>
      <td>' . $voterbatch . '</td>
      <td>' . $row['student_id'] . '</td>
      <td>
    <button class="btn btn-dark" onclick="voteredit(' . $id . ')">Update</button>
    <button class="btn btn-danger"onclick="deletevoter(' . $id . ')">Delete</button>
</td>
    </tr>';
    }
    $table .= '</table>';
    echo $table;
}