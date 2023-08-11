<?php
session_start();
include_once "../php/db.php";

if (!empty($_POST) && !empty($_POST['new_password']) && !empty($_POST['confirm_new_password'])) {
    $voterId = $_SESSION['forgot-pass']['voterinfo']['voterid'];
    $newPass = $_POST['new_password'];
    $confirmPass = $_POST['confirm_new_password'];
    if ($newPass == $confirmPass) {
        $result = updatePassword($newPass, $voterId, $conn);
        if ($result) {
            $_SESSION['voter_success_msg'] = 'Password Updated Successfully';
            $response = [
                'status' => true,
            ];
        }else {
            $response = [
                'status' => false,
                'msg' => 'Failed to update password'
            ];
        }
    }else {
        $response = [
            'status' => false,
            'msg' => 'New Password and Confirm password did not match'
        ];
    }
    echo json_encode($response);
    exit();
}
$response = [
    'status' => false,
    'msg' => 'Request is empty'
];
echo json_encode($response);
exit();


function updatePassword($pass, $voterId, $conn) {
    $encryptedPass = passwordEncrypt($pass);
    $query = "UPDATE `voterinfo` SET password='$encryptedPass' WHERE voterid='$voterId'";
    $result = mysqli_query($conn,$query);
    if ($result) {
        return true;
    }
    return false;
}

function passwordEncrypt($password) {
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = '4750d4975e73c470699164fd39a732facfe1b5bd79473866a15ea1b4963cd17b';

    return openssl_encrypt(trim($password), $ciphering, $encryption_key, $options, $encryption_iv);
}
