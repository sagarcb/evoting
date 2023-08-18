<?php
error_reporting(0);
session_start();
include 'php/db.php';
$unique_id = $_SESSION['id'];
$random = $_SESSION['adminid'];
$email = $_SESSION['email'];
$password = $_SESSION['password'];

$qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE email = '{$email}'");
if (mysqli_num_rows($qry)==0) {
    $row = mysqli_fetch_assoc($qry);
    if (empty($row)){

        header("Location:/evoting/index.php");
    }
}
$qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
if (mysqli_num_rows($qry) > 0) {
    $row = mysqli_fetch_assoc($qry);
    if ($row) {
        $_SESSION['email_verification_status'] = $row['email_verification_status'];
        if ($row['email_verification_status'] != '1') {
            header("Location:/evoting/loginverify.php");
        }
    }
}
$qry = mysqli_query($conn, "SELECT * FROM admininfo WHERE adminid = '{$random}'");
if (mysqli_num_rows($qry) > 0) {
    $row = mysqli_fetch_assoc($qry);
    if ($row) {
        $_SESSION['email_verification_status'] = $row['email_verification_status'];
        if ($row['email_verification_status'] != '1') {
            header("Location:/evoting/verify.php");
        }
    }
}
