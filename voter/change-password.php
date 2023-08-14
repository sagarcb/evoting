<?php
session_start();
include_once "unauthenticated_redirection.php";
?>
<?php include_once "php/db.php";?>
<?php
    if (isset($_POST) && !empty($_POST)) {
        if (isset($_GET['voterid'])) {
            $voterid = $_GET['voterid'];

            $oldPass = $_POST['old_password'];
            $newPass = $_POST['new_password'];
            $confirmPass = $_POST['confirm_new_password'];

            if ($newPass !== $confirmPass) {
                $response = [
                    'status' => false,
                    'msg'    => "New Password and Confirm Password didn't match!"
                ];
                echo json_encode($response);
                exit();
            }

            $voterDataQuery = "SELECT * FROM `voterinfo` where voterid='$voterid'";
            $result = mysqli_query($conn, $voterDataQuery);
            $data = mysqli_fetch_assoc($result);
            if (!$data) {
                $response = [
                    'status' => false,
                    'msg'    => "Voter data not found!"
                ];
                echo json_encode($response);
                exit();
            }

            $verifyPassword = verifyPassword($oldPass, $data['password']);
            if ($verifyPassword) {
                $otp = rand(111111, 999999);
                //$otp = 123456;
                $_SESSION['change_password']['otp'] = $otp;
                $_SESSION['change_password']['newpassword'] = $newPass;
                $_SESSION['change_password']['voterid'] = $voterid;
                $sendEmail = sendEmail($voterid, $conn, $otp);
                if ($sendEmail) {
                    $response = [
                        'status' => true
                    ];
                    echo json_encode($response);
                    exit();
                }else {
                    $response = [
                        'status' => true
                    ];
                    echo json_encode($response);
                    exit();
                }
            }
            $response = [
                'status' => false,
                'msg'    => "The old password didn't match!"
            ];
            echo json_encode($response);
            exit();
        }
        $response = [
            'status' => false,
            'msg'    => 'Voter ID not found!'
        ];
        echo json_encode($response);
        exit();
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

function sendEmail($voterid, $conn, $otp) {
    $query = "SELECT * FROM `voterinfo` WHERE voterid='$voterid'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $receiver = $data['email'];
        $subject = "OTP Verification";
        $body = "Hello " . $data['votername'] . ", \n Your password change request OTP: $otp \nSincerely, \n SUB";
        $sender = "From: shonpollock0@gmail.com";
        if (mail($receiver, $subject, $body, $sender)) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}
?>


<?php include 'header.php'?>
    <div class="container">
        <?php include 'navbar.php' ?>
        <style>
            .main-content {
                border: 1px solid #198754;
                border-radius: 10px;
            }
            .main-content .heading {
                background: #198754;
                border-radius: 8px 8px 0 0;
                height: 50px;
                color: white;
                padding-left: 1%;
                padding-top: 0.7%;
            }


            .change-pass-form {
                width: 40%;
                margin: 5% auto 10px;
            }

            .passwordErrorMsgDiv {
                margin-left: 5%;
            }

            #changePassBtn {
                background: #198754;
                border-radius: 5px;
                cursor: pointer;
                color: #FFFFFF;
                border: none;
                height: 40px;
                width: 40%;
            }
        </style>



        <div class="main-content">
            <div class="heading">
                <h3>Change Your Password:</h3>
            </div>
            <div class="change-pass-form">
                <form method="post" action="change-password.php" id="changePassForm">
                    <div class="form-group row">
                        <label for="oldPass" class="col-sm-4 col-form-label">Old Password:</label>
                        <div class="col-sm-8">
                            <input type="password" name="old_password" class="form-control" id="oldPass" placeholder="Old Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="newPass" class="col-sm-4 col-form-label">New Password:</label>
                        <div class="col-sm-8">
                            <input type="password" name="new_password" class="form-control" id="newPass" placeholder="New Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirmNewPass" class="col-sm-4 col-form-label">Confirm New Password:</label>
                        <div class="col-sm-8">
                            <input type="password" name="confirm_new_password" class="form-control" id="confirmNewPass" placeholder="Confirm New Password" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="passwordErrorMsgDiv">
                            <p id="password-match-message" style="float: left"></p>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="changePassBtn">Change Password</button>
                </form>
            </div>
        </div>
    </div>
<?php include 'copyright.php'?>
<?php include 'footer.php'?>

<style>
    .footer {
        margin-top: 7.5%!important;
        position: fixed;
    }
</style>

<script>
    $(document).ready(function () {
        $("#newPass, #confirmNewPass").on("keyup", function() {
            var newPassword = $("#newPass").val();
            var confirmPassword = $("#confirmNewPass").val();
            var changePassBtn = $('#changePassBtn');

            if (newPassword === confirmPassword) {
                $("#password-match-message").text("* New Password and Confirm Passwords match!").css("color", "green");
                $(changePassBtn).attr('type', 'submit');
            } else {
                $("#password-match-message").text("* New Password and Confirm Passwords do not match!").css("color", "red");
                $(changePassBtn).attr('type', 'button');
            }
        });

        $('#changePassForm').on('submit', function (e) {
            e.preventDefault();
            let msgElement = $('#password-match-message')
            let form = document.getElementById('changePassForm');
            const formData = new FormData(form);
            $.ajax({
                url: './change-password.php?voterid=<?=$voterid?>',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    let resp = JSON.parse(data);
                    if (resp.status) {
                        window.location.href = "./php/otpverification.php";
                    }else {
                        $(msgElement).text(resp.msg).css("color", "red");
                        $('#changePassForm').trigger('reset');
                    }
                },
                error: function (err) {
                    console.log(err)
                }
            });
        })
    })
</script>
