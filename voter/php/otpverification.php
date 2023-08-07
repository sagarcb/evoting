<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="../css/voterverify.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/voterform.css?v=<?php echo time(); ?>">
    <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        window.onload = preventBack();
        setTimeout("preventBack()", 0);
        window.onunload = function () { null };

    </script>
</head>

<body>
<!-- <img src="img/cont.jpg" class="pic"> -->
<div class="form">
    <section class="header">
        <h1>Verification</h1>
        <img src="../img/profile.jpg" class="profile">
        <h3> The OTP code has been </h3>
        <h4> send to ******@gmail.com </h4>
    </section>


    <form action="" autocomplete="off" class="input">
        <div class="result">Error</div>
        <div class="inputs">
            <input type="number" name="otp1" required onpaste="return false">
            <input type="number" name="otp2" disabled required onpaste="return false" />
            <input type="number" name="otp3" disabled required onpaste="return false" />
            <input type="number" name="otp4" disabled required onpaste="return false" />
            <input type="number" name="otp5" disabled required onpaste="return false" />
            <input type="number" name="otp6" disabled required onpaste="return false" />
        </div>
        <div class="btn">
            <button type="submit" name="button" class="button" onclick="preeventBack()">Verify
        </div>
    </form>

</div>
<script src="../js/otpverification.js?v=<?php echo time(); ?>"></script>
<script>
    const inputs = document.querySelectorAll("input"),
        button = document.querySelector("button");


    inputs.forEach((input, index1) => {
        input.addEventListener("keyup", (e) => {

            const currentInput = input,
                nextInput = input.nextElementSibling,
                prevInput = input.previousElementSibling;
            if (currentInput.value.length > 1) {
                currentInput.value = "";
                return;
            }

            if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
                nextInput.removeAttribute("disabled");
                nextInput.focus();
            }


            if (e.key === "Backspace") {
                inputs.forEach((input, index2) => {
                    if (index1 <= index2 && prevInput) {
                        input.setAttribute("disabled", true);
                        input.value = "";
                        prevInput.focus();
                    }
                });
            }
            if (!inputs[5].disabled && inputs[5].value !== "") {
                button.classList.add("active");
                return;
            }
            button.classList.remove("active");
        });
    });
    window.addEventListener("load", () => inputs[0].focus());


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