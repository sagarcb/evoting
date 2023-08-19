<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Signup Form</title>
        <link rel="stylesheet" href="css/voterform.css?v=<?php echo time(); ?>">
        <!-- <link rel="stylesheet" href="css/verify.css"> -->
        <link rel="stylesheet" href="css/loader.css?v=<?php echo time(); ?>">
        <!-- <link rel="stylesheet" href="css/bloader.css?v=<?php echo time(); ?>"> -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        <div class="form-box">
            <div class="form">

                <form action="" enctype="multipart/form-data">
                    <h2>Register</h2>
                    <p class="error-text" style="margin-top: -5%">error
                    </p>
                    <div class="input-box">
                        <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                        <input type="text" name="name" placeholder="Voter Name">
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                        <input type="text" name="batch" placeholder="Enter Batch">
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                        <input type="password" id="pass" name="pass" placeholder="Password">
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                        <input type="password" id="cpass" name="cpass" placeholder="Confirm Password"
                            oninvalid="this.setCustomValidity('Enter 11 Digits Number')"
                            oninput="this.setCustomValidity('')" disabled>
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                        <input type="text" name="student_id" placeholder="Student ID">
                    </div>
                    <div class="submit">
                        <input type="submit" class="button" value="Register" onclick="function()">
                        <!-- <div class="loader"></div> -->
                    </div>
                    <div class="group" style="margin-top:10px">
<!--                        <span><a href="forgot.php">Forgot-Password</a></span>-->
                        <span><a href="index.php">Login</a></span>
                    </div>
                </form>
            </div>
        </div>
        <script src="js/voterregister.js?v=<?php echo time(); ?>"></script>
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
            $('#pass').keyup(function () {
                var len = $(this).val().length;
                if (len >= 6) {
                    $("#cpass").prop("disabled", false);
                }
                else {
                    $("#cpass").prop("disabled", true);
                }
            });
        </script>
        <script>
            function disable_wp_emojicons() {

                /* all actions related to emojis */
                remove_action('admin_print_styles', 'print_emoji_styles');
                remove_action('wp_head', 'print_emoji_detection_script', 7);
                remove_action('admin_print_scripts', 'print_emoji_detection_script');
                remove_action('wp_print_styles', 'print_emoji_styles');
                remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
                remove_filter('the_content_feed', 'wp_staticize_emoji');
                remove_filter('comment_text_rss', 'wp_staticize_emoji');

                /* filter to remove TinyMCE emojis */
                add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
            }

// $(".btn").click(function(){
//   $("div").animate({
//     left: '250px',
//     opacity: '0.5',
//     height: '150px',
//     width: '150px'
//   });
// });
        </script>
        <script>
            // submit = document.querySelector(".submit");
            // submit.onclick = function(){
            //     this.innerHTML ="<div class='loader'></div>"
            //     setTimeout(() =>
            //     {
            //         this.innerHTML = "changes Saved";


            //     },2000)
            // }
            </script>
    </body>

</html>
