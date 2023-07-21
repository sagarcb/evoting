<?php
include 'db.php';
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = '323232323fjaksdfjalsdf';

if (isset($_POST['vupdateid'])) {
    $voter_id = $_POST['vupdateid'];

    $sql = "select * from `voterinfo` where voterid=$voter_id";
    $result = mysqli_query($conn, $sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $row['password'] = openssl_decrypt ($row['password'], $ciphering, $encryption_key, $options, $encryption_iv);
        $response = $row;
    }
    echo json_encode($response);
    exit();
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid";
    echo json_encode($response);
}

//update query
if (isset($_POST['voterhiddendata'])) {
    $unique_id = $_POST['voterhiddendata'];
    $name = $_POST['updatename'];
    $email = $_POST['updateemail'];
    $pass = openssl_encrypt($_POST['updatepass'], $ciphering, $encryption_key, $options, $encryption_iv);
    $batch = $_POST['updatebatch'];
    $student_id = $_POST['student_id'];

    $sql = "update `voterinfo` set votername='$name',email='$email',password='$pass',batch='$batch',student_id='$student_id' where voterid=$unique_id";
    $result = mysqli_query($conn, $sql);

}
?>