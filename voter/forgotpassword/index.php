<?php include_once "../php/db.php";?>

<?php include '../header.php'?>
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
            width: 55%;
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
            margin-left: 29%;
        }
    </style>



    <div class="main-content">
        <div class="heading">
            <h3>Verify It's you:</h3>
        </div>
        <div class="change-pass-form">
            <form method="post" action="forgot-password-backend.php" id="changePassForm">
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Enter your email address:</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Email.." required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="passwordErrorMsgDiv ml-auto mr-auto">
                        <p id="password-match-message"></p>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" id="changePassBtn">Submit</button>
            </form>
        </div>
    </div>
</div>
<?php include '../copyright.php'?>
<?php include '../footer.php'?>

<style>
    .footer {
        margin-top: 17.5%;
        position:fixed!important;
    }
</style>

<script>
    $(document).ready(function () {
        $('#changePassForm').on('submit', function (e) {
            e.preventDefault();
            let msgElement = $('#password-match-message')
            let form = document.getElementById('changePassForm');
            const formData = new FormData(form);
            $.ajax({
                url: './email-verify.php',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    let resp = JSON.parse(data);
                    if (resp.status) {
                        window.location.href = "./verification.php";
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
