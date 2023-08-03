<?php
include '../../php/db.php';

$table = '<table class="table">
  <thead>
    <tr>
      <th scope="col">Serial Number</th>
      <th scope="col">Candidate Name</th>
      <th scope="col">Candidate Email</th>
      <th scope="col">Voter Batch</th>
      <th scope="col">Candidate Image</th>
       <th scope="col">Action</th>
        
    </tr>
  </thead>';
$sql = "select * from `candidateinfo`";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['candidateid'];
    $candidateemail = $row['candidatemail'];
    $candidatename = $row['candidatename'];
    $candidatebatch = $row['batch'];
    $imageUrl = './candidate_images/avatar.jpg';
    if ($row['candidateimage']) {
        $imageUrl = './candidate_images/' . $row['candidateimage'];
    }
    $table .= '<tr>
      <td scope="row">' . $row['serial'] . '</td>
      <td>' . $candidatename . '</td>
      <td>' . $candidateemail . '</td>
      <td>' . $candidatebatch . '</td>
      <td>
         <div class="image-container">
            <img src="'.$imageUrl.'" alt="Rounded Image">
         </div>
      </td>
      <td>
    <button class="btn btn-dark" data-id="'.$id.'" id="updateCandidateBtn">Update</button>
    <button class="btn btn-danger" id="deleteCandidateBtn" data-id="'.$id.'">Delete</button>
</td>
    </tr>';
}
$table .= '</table>';
echo $table;
