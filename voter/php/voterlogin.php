<?php
error_reporting(0);
session_start();
include "db.php";
$email = $_POST['email'];
$password = $_POST['pass'];
$email_verification_status = '0';
$random_id = $_SESSION['id'];
// $otp = $_POST['otp'];

// checking fields are not empty
if (!empty($email) && !empty($password)) {
    $sql = mysqli_query($conn, "SELECT * FROM voterinfo WHERE email = '{$email}'");
    if (mysqli_num_rows($sql) > 0) {
        $row1 = mysqli_fetch_assoc($sql);
//        $verify = password_verify($password, $row1['password']);
        $verify = verifyPassword($password, $row1['password']);
        if ($verify == 1) {
            $_SESSION['IS_LOGIN'] = true;
            $random_id = rand(time(), 10000000);
            $otp = mt_rand(111111, 999999);
//            $password = password_hash($password, PASSWORD_BCRYPT);
            $password = passwordEncrypt($password);
            $deletePreviousLoginQuery = "DELETE FROM voterlogin WHERE email='$email'";
            mysqli_query($conn, $deletePreviousLoginQuery);

            $sql2 = mysqli_query($conn, "INSERT INTO voterlogin(email, password,otp,email_verification_status)
                    VALUES ('{$email}','{$password}','{$otp}','$email_verification_status')");

            
            if ($sql2) {
                $sql3 = mysqli_query($conn, "SELECT * FROM voterlogin WHERE email = '{$email}' ORDER BY id DESC");
                if (mysqli_num_rows($sql3) > 0) {
                    $row = mysqli_fetch_assoc($sql3);
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['otp'] = $row['otp'];
                    $_SESSION['voterinfo'] = $row1;
                    //mail function
                    if ($otp) {
                        $receiver = $email;
                        $subject = "From:  <$email>";
                        $body = "Name " . "\n Email" . " $email \n Otp" . " $otp";
                        $sender = "From: shonpollock0@gmail.com";

                        if (mail($receiver, $subject, $body, $sender)) {
                            echo "success";
                        } else {
                            echo "Email Problem!" . mysqli_error($conn);
                        }
                    }

                    // mail function end
                }
            } else {
                echo "Somethings went wrong! " . mysqli_error($conn);
            }


            // else {
            //     echo "Password Don't Match!";

            // }
        } else {
            echo "Please Enter Correct Password";
        }
    } else {
        echo "This Account Doesn't Exist";
    }

} else {
    if (empty($email)) {
        printf("Please enter your email address");
    } else if (empty($password)) {
        printf("Please enter Password");
    }
}


function passwordEncrypt($password) {
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = '4750d4975e73c470699164fd39a732facfe1b5bd79473866a15ea1b4963cd17b';

    return openssl_encrypt(trim($password), $ciphering, $encryption_key, $options, $encryption_iv);
}

function verifyPassword($inputPass, $dbPass) {
    $encryptInputPass = passwordEncrypt($inputPass);
    if ($encryptInputPass === $dbPass) {
        return true;
    }
    return false;
}