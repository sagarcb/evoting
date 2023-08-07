<?php include_once "unauthenticated_redirection.php"?>
<?php include_once "php/db.php"?>
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
                $newEncryptedPassword = passwordEncrypt($newPass);
                $updatePassQuery = "UPDATE `voterinfo` SET password='$newEncryptedPassword' WHERE voterid='$voterid'";
                $result = mysqli_query($conn, $updatePassQuery);
                if ($result) {
                    $_SESSION['voter_success_msg'] = 'Password Updated Successfully!';
                    $response = [
                        'status' => true,
                        'msg' => 'Password Updated Successfully!'
                    ];
                    echo json_encode($response);
                    exit();
                }
                $response = [
                    'status' => false,
                    'msg' => 'Failed to update password!'
                ];
                echo json_encode($response);
                exit();
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
?>


<?php include 'header.php'?>
    <div class="container">
        <?php include 'navbar.php' ?>
        <style>
            .main-content {
                border: 1px solid #eeebeb;
                text-align: center;
                background: #fffcf5;
                padding-top: 5%;
                padding-bottom: 10%;
            }

            .change-pass-form {
                width: 40%;
                margin-top: 5%;
                margin-left: auto;
                margin-right: auto;
            }

            .passwordErrorMsgDiv {
                margin-left: 5%;
            }
        </style>



        <div class="main-content">
            <h3>Change Your Password:</h3>
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
                        <label for="confirmNewPass" class="col-sm-4 col-form-label">New Password:</label>
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
<?php include 'footer.php'?>

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
                        window.location.href = "dashboard.php";
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