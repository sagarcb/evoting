<?php
// error_reporting(0);
// session_start();
// include 'php/db.php';
// $unique_id = $_SESSION['id'];
// $random = $_SESSION['adminid'];

// $qry = mysqli_query($conn, "SELECT * FROM admininfo WHERE adminid = '{$random}'");
// if (mysqli_num_rows($qry) > 0) {
//     $row = mysqli_fetch_assoc($qry);
//     if ($row) {
//         $_SESSION['email_verification_status'] = $row['email_verification_status'];
//         if ($row['email_verification_status'] != '1') {
//             header("Location: verify.php");
//         }
//     }
// }
// $qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
// if (mysqli_num_rows($qry) > 0) {
//     $row = mysqli_fetch_assoc($qry);
//     if ($row) {
//         $_SESSION['email_verification_status'] = $row['email_verification_status'];
//         if ($row['email_verification_status'] != '1') {
//             header("Location: loginverify.php");
//         }
//     }
// }
// $qry = mysqli_query($conn, "SELECT * FROM adminlogin WHERE id = '{$unique_id}'");
// if (mysqli_num_rows($qry) > 0) {
//     $row = mysqli_fetch_assoc($qry);
//     if ($row) {
//         $_SESSION['email_verification_status'] = $row['email_verification_status'];
//         if ($row['email_verification_status'] == '1') {
//             header("Location:Dashboard/dashboard.php");
//         }
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup Form</title>
     <link rel="stylesheet" href="css/form.css?v=<?php echo time(); ?>">
    <!-- <link rel="stylesheet" href="css/verify.css"> -->
    <link rel="stylesheet" href="css/loader.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type= "text/javascript">
        function preventBack(){
            window.history.forward();
        }
        setTimeout("preventBack()" ,0);
        window.onunload = function() { null };

    </script>
</head>

<body>
<!-- <img src="img/cont.jpg" class="pic"> -->
    <!-- loader -->

    <div id="loader">
        <div class="loader row-item">
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
            <span class="circle"></span>
        </div>
    </div>
    <!-- loader end -->

    <!-- <img src="img/bg_img.svg" class="image" alt=""> -->
    <div class="form-box">
        <div class="form">
            <form action="" enctype="multipart/form-data">
                <h3>Reset Password</h3>
                <p class="error-text">Error</p>
                <div class="input-box">
                    <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                    <input type="email" name="email" placeholder="Enter Email Address">
                </div>
                <div class="input-box">
                    <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                    <input type="password" id="password" name="pass" placeholder="New Password">
                </div>
                <div class="input-box">
                    <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                    <input type="password" id="cpassword" name="cpass" placeholder="Confirm Password"
                        oninvalid="this.setCustomValidity('Enter 11 Digits Number')"
                        oninput="this.setCustomValidity('')" disabled>
                </div>
                <div class="submit">
                    <input type="submit" class="button" value="Continue" onclick=" preventBack();">
                </div>
                <div class="group">
                    <span><a href="register.php">Signup</a></span>
                    <span><a href="index.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
    <script src="js/forgot.js?v=<?php echo time(); ?>"></script>
    <script>
        $(document).ready(function () {
            //Preloader
            preloaderFadeOutTime = 1200;
            function hidePreloader() {
                var preloader = $('#loader');
                preloader.fadeOut(preloaderFadeOutTime);
            }
            hidePreloader();
        });
    </script>
    
      
    <script>
  $('#password').keyup(function () {
    var len = $(this).val().length;
    if (len >= 6) {
        $("#cpassword").prop("disabled", false);
    }
    else{
        $("#cpassword").prop("disabled", true);
    }
});
    </script>
    <script>
    
    </script>
</body>

</html>