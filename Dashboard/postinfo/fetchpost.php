<?php
include 'db.php';
if (isset($_POST['displaySend'])) {
    $table = '<table class="table">
  <thead>
    <tr>
      <th scope="col">Post Serial Number</th>
      <th scope="col">Number of Seat</th>
      <th scope="col">Post Type</th>
      <th scope="col">Post Description</th>
       <th scope="col">Action</th>
        
    </tr>
  </thead>';
    $sql = "select * from `postinfo`";
    $result = mysqli_query($conn, $sql);
    $number = 1;
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['postid'];
        $postnum = $row['numberofseat'];
        $posttype = $row['posttype'];
        $postdesc = $row['postdescription'];
        $table .= '<tr>
      <td scope="row">' . $number . '</td>
      <td>' . $postnum . '</td>
      <td>' . $posttype . '</td>
      <td>' . $postdesc . '</td>
      <td>
    <button class="btn btn-dark" onclick="GetDetails(' . $id . ')">Update</button>
    <button class="btn btn-danger"onclick="DeleteUser(' . $id . ')">Delete</button>
</td>
    </tr>';
        $number++;
    }
    $table .= '</table>';
    echo $table;
}


?>