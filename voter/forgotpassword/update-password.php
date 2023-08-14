<?php include_once "../php/db.php";?>
<?php include '../header.php'?>
<?php
if (!isset($_SESSION['forgot-pass'])) {
    header('location:index.php');
}
?>
<div class="container">
    <?php include '../navbar.php' ?>
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
            <form method="post" action="" id="changePassForm">
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
<?php include '../copyright.php'?>
<?php include '../footer.php'?>

<style>
    .footer {
        margin-top: 20%;
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
                url: './update-password-backend.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    let resp = JSON.parse(data);
                    if (resp.status) {
                        window.location.href = "../dashboard.php";
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
