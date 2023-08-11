<?php
session_start();
include_once "../php/db.php";

$response = [];

if (!empty($_POST['email'])) {
    $email = trim($_POST['email']);
    $response = checkUserExistAndSendEmail($email, $conn);
}else {
    $response = [
      'status' => false,
      'msg' => 'Voter ID or Email Address is empty!'
    ];
}

echo json_encode($response);
exit();

function checkUserExistAndSendEmail($email, $conn) {
    $query = "SELECT * FROM `voterinfo` WHERE email='$email'";
    $data = mysqli_query($conn, $query)->fetch_assoc();
    if (!empty($data)) {
        $emailStatus = sendEmail($data);
        if ($emailStatus) {
            $_SESSION['forgot-pass']['voterinfo'] = $data;
            return [
                'status' => true
            ];
        }
        return [
            'status' => false,
            'msg' => 'Failed to send email'
        ];
    }
    return [
        'status' => false,
        'msg' => 'No voter found with this email ID!'
    ];
}

function sendEmail($data) {
    $otp = rand(100000,999999);
    $_SESSION['forgot-pass']['otp'] = $otp;
    $receiver = $data['email'];
    $subject = "Forgot Password OTP Verification";
    $body = "Hello " . $data['votername'] . ", \n Your forgot password request OTP: $otp \nSincerely, \n SUB";
    $sender = "From: shonpollock0@gmail.com";
    if (mail($receiver, $subject, $body, $sender)) {
        return true;
    }
    return false;
}
