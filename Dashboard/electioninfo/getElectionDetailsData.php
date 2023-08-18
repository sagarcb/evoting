<?php

include_once "../php/db.php";

$query = "SELECT * FROM `electioninfo`";
$data = mysqli_query($conn, $query)->fetch_assoc();
if ($data) {
    $response = [
        'status' => true,
        'data' => $data
    ];
}else {
    $response = [
        'status' => false
    ];
}
echo json_encode($response);
exit();
