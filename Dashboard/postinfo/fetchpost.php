<?php
include 'db.php';
if (isset($_POST['displaySend'])) {
    $table = '<table class="table">
  <thead>
    <tr>
      <th scope="col">Post ID</th>
      <th scope="col">Number of Seat</th>
      <th scope="col">Post Type</th>
      <th scope="col">Post Description</th>
      <th scope="col">Number of select person</th>
       <th scope="col">Action</th>
        
    </tr>
  </thead>';
    $sql = "select * from `postinfo` ORDER BY serial";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['postid'];
        $postnum = $row['numberofseat'];
        $posttype = $row['posttype'];
        $postdesc = $row['postdescription'];
        $multiple_person = $row['multiple_person'];
        $table .= '<tr>
      <td scope="row">' . $id . '</td>
      <td>' . $postnum . '</td>
      <td>' . $posttype . '</td>
      <td>' . $postdesc . '</td>
      <td>' . $multiple_person . '</td>
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
