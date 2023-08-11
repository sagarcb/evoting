<?php
session_start();
if (!isset($_SESSION['forgot-pass'])) {
    header('location:index.php');
}

if (!empty($_POST)) {
    $otp1 = $_POST['otp1'];
    $otp2 = $_POST['otp2'];
    $otp3 = $_POST['otp3'];
    $otp4 = $_POST['otp4'];
    $otp5 = $_POST['otp5'];
    $otp6 = $_POST['otp6'];

    $session_otp = $_SESSION['forgot-pass']['otp'];

    $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

    if (!empty($otp)) {
        if ($otp == $session_otp) {
            echo 'success';
        } else {
            echo "Wrong Otp!";
        }
    } else {
        echo "Please enter the otp code!";
    }
}