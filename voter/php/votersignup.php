<?php
error_reporting(0);
session_start();
include_once "db.php";
$email = $_POST['email'];
$password = mysqli_real_escape_string($conn, $_POST['pass']);
$cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);
$name = $_POST['name'];
$batch = $_POST['batch'];
$student_id = $_POST['student_id'];
$email_verification_status = '0';
$loginstatus = '0';
$votecaststatus = '0';
// $last_id = $_POST['voterid'];

// checking fields are not empty
if (!empty($email) && !empty($password) && !empty($cpassword) && !empty($name) && !empty($batch) && !empty($student_id)) {

    //if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        //checking email already exists
        $sql = mysqli_query($conn, "SELECT email FROM voterinfo WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            echo "This email is already exists!";
        } else {
            if ($password == $cpassword) {
                // $last_id = mysqli_insert_id($conn);
                // $code = rand(11, 99);
                // $random_id = "Subadmin" . $code . "_" . $last_id;
                // $query = "UPDATE admininfo SET adminid = '" . $random_id . "' WHERE  adminid = '" . $random_id . "'";
                // $res = mysqli_query($conn, $query);

                //let's check user upload file or not
                $otp = mt_rand(111111, 999999);
                $last_id = rand(time(), 10000000);
                // let's start insert data into table
//                $password = password_hash($password, PASSWORD_BCRYPT);
                $password = passwordEncrypt($password);

                $sql2 = mysqli_query($conn, "INSERT INTO voterinfo(voterid,email, password,otp,email_verification_status,votername,batch,loginstatus,votecaststatus,student_id)
                    VALUES ({$last_id},'{$email}','{$password}','{$otp}','{$email_verification_status}','{$name}','{$batch}','{$loginstatus}','{$votecaststatus}','{$student_id}')");

                if ($sql2) {
                    // $last_id = mysqli_insert_id($conn);
                    // $code = rand(1, 99);
                    // $random_id = "Subadmin" ."_". $code;
                    // $query = "UPDATE admininfo SET adminid = '" . $random_id . "' WHERE  adminid = '" . $last_id . "'";
                    // $res = mysqli_query($conn, $query);
                    // if ($res) {

                    $sql3 = mysqli_query($conn, "SELECT * FROM voterinfo WHERE email = '{$email}'");
                    if (mysqli_num_rows($sql3) > 0) {
                        $row = mysqli_fetch_assoc($sql3);
                        $_SESSION['voterid'] = $row['voterid'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['otp'] = $row['otp'];
                        //mail function
                        if ($otp) {
                            $receiver = $email;
                            $subject = "From:  <$email>";
                            $body = "Name " . "\n Email" . " $email \n Otp" . " $otp";
                            $sender = "From: shonpollock0@gmail.com";

                            if (mail($receiver, $subject, $body, $sender)) {
                                echo "success";
                            } else {
                                echo "Something Went Wrong
                                    " . mysqli_error($conn);
                            }
                        }

                        // mail function end

                    }
                    // }

                } else {
                    echo "Something Went wrong! " . mysqli_error($conn);
                }



            } else {
                echo "Confirm Password Doesn't Match";

            }
        }

    } else {
        echo "This is not valid Email!";
    }
} else {
    if (empty($name)) {
        printf("Enter your name*");
    } else if (empty($batch)) {
        printf("Please Enter Batch*");
    } elseif (empty($email)) {
        printf("Please Enter Email*");

    } else if (strlen($password) < 6) {
        printf("Password minimum six digits or letters*");
    } else if (empty($cpassword)) {
        printf("Please Enter Confirm Password*");
    } else if (strlen($cpassword) < 6) {
        printf("Password minimum six digits or letters*");
    }else if (empty($student_id)) {
        printf("Student ID field is empty*");
    }
}

function passwordEncrypt($password) {
    $ciphering = "AES-128-CTR";
    $options = 0;
    $encryption_iv = '1234567891011121';
    $encryption_key = '4750d4975e73c470699164fd39a732facfe1b5bd79473866a15ea1b4963cd17b';

    return openssl_encrypt(trim($password), $ciphering, $encryption_key, $options, $encryption_iv);
}
