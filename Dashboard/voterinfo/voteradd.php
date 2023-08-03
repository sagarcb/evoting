<?php
include 'db.php';

extract($_POST);

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = '4750d4975e73c470699164fd39a732facfe1b5bd79473866a15ea1b4963cd17b';

if (isset($_POST['voternameSend']) && isset($_POST['voteremailSend']) && isset($_POST['voterpassSend']) && isset($_POST['voterbatchSend']) && isset($_POST['student_id'])) {

    /*Check user already exist*/
    $checkUserExistByEmail = checkUserAlreadyExist($conn, true , $_POST['voteremailSend']);
    $checkUserExistByStudentId = checkUserAlreadyExist($conn, false, null, true, $_POST['student_id']);
    if ($checkUserExistByEmail) {
        $response = [
            'status' => false,
            'msg' => 'This email is already exist'
        ];
        echo json_encode($response);
        exit();
    }

    if ($checkUserExistByStudentId) {
        $response = [
            'status' => false,
            'msg' => 'This Student Id is already exist'
        ];
        echo json_encode($response);
        exit();
    }
    $password = openssl_encrypt($_POST['voterpassSend'], $ciphering, $encryption_key, $options, $encryption_iv);
    $voterid = rand(111111,999999);

    $sql = "insert into `voterinfo`(voterid,password,email,votername,batch, student_id) values('$voterid','$password','$voteremailSend','$voternameSend','$voterbatchSend', '$student_id')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
       $response = [
           'status' => true,
       ];
       echo json_encode($response);
       exit();
   }else {
       $response = [
           'status' => false,
           'msg' => 'Failed to add'
       ];
       echo json_encode($response);
       exit();
   }



}

function checkUserAlreadyExist($conn, $checkByEmail = false, $email = null, $checkByStudentId = false, $student_id = null) {
    $sql = '';
    if ($checkByEmail) {
        $sql = "SELECT * FROM `voterinfo` where email='$email'";
    }else if ($checkByStudentId) {
        $sql = "SELECT * FROM `voterinfo` where student_id='$student_id'";
    }
    if ($sql) {
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all();
        if (count($data) > 0) {
            return true;
        }
        return false;
    }

    return true;
}

?>