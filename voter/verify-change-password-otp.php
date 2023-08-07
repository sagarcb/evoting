<?php
session_start();

include_once "./php/db.php";
if (!empty($_POST)) {
    if (isset($_SESSION['change_password']['otp']) && isset($_SESSION['change_password']['newpassword']) && isset($_SESSION['change_password']['voterid'])) {
        $voterid = $_SESSION['change_password']['voterid'];
        $newPass = $_SESSION['change_password']['newpassword'];
        $otp = $_SESSION['change_password']['otp'];

        $otp1 = $_POST['otp1'];
        $otp2 = $_POST['otp2'];
        $otp3 = $_POST['otp3'];
        $otp4 = $_POST['otp4'];
        $otp5 = $_POST['otp5'];
        $otp6 = $_POST['otp6'];

        $submittedOtp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;
        if ($otp == $submittedOtp) {
            $newEncryptedPassword = passwordEncrypt($newPass);
            $updatePassQuery = "UPDATE `voterinfo` SET password='$newEncryptedPassword' WHERE voterid='$voterid'";
            $result = mysqli_query($conn, $updatePassQuery);
            if ($result) {
                $_SESSION['voter_success_msg'] = 'Password Updated Successfully!';
                echo 'success';
                exit();
            }
            echo 'error';
            exit();
        }else {
            echo 'OTP did not match!';
            exit();
        }
    }else {
        echo 'Something went wrong!';
        exit();
    }
}else {
    echo 'Something went wrong!';
    exit();
}

function passwordEncrypt($password) {
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = '4750d4975e73c470699164fd39a732facfe1b5bd79473866a15ea1b4963cd17b';

    return openssl_encrypt(trim($password), $ciphering, $encryption_key, $options, $encryption_iv);
}