<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in & Sign Up Form</title>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="css/voterform.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="css/loader.css?v=<?php echo time(); ?>">
    </head>

    <body>
        <!-- <img src="img/cont.jpg" class="pic"> -->
        <div id="loader">
            <div class="loader row-item">
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
                <span class="circle"></span>
            </div>
        </div>
        <div class="form-box">
            <div class="form">
                <form action="" enctype="multipart/form-data">
                    <div class="text-center" style="margin-top: -50%; margin-bottom: 10%;">
                        <img style="margin-left: 21%" src="https://www.sub.ac.bd/uploads/logo/cdcbff91d69b664eef72.jpg" height="50" alt="">
                    </div>
                    <h2>Voter Login</h2>
                    <div class="error">Error</div>
                    <div class="input-box">
                        <i class='bx bxs-envelope' style='color:#0b3d0b'></i>
                        <input type="email" name="email" placeholder="Enter Email Address">
                    </div>
                    <div class="input-box">
                        <i class='bx bxs-lock-alt' style='color:#0b3d0b'></i>
                        <input type="password" name="pass" placeholder="Enter Password">
                    </div>
                    <div class="submit">
                        <input type="submit" id="yes" name="button" class="button" value="Login Now">
                    </div>
                    <div class="group">
                        <span><a href="voterregister.php">Signup</a></span>
                        <span><a href="./forgotpassword/index.php">Forgot Password</a></span>
                    </div>
                </form>
            </div>

        </div>
    </body>

</html>
<script src="js/voterlogin.js?v=<?php echo time(); ?>"></script>
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
</script>


</body>

</html>