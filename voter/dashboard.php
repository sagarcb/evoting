<?php include 'unauthenticated_redirection.php'?>
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
            height: 65px;
            color: white;
            padding-left: 1%;
            padding-top: 1.3%;
        }

        .main-content .body {
            text-align: center;
            margin-top: 2%;
            margin-bottom: 3%;
        }

        .club-logo img {
            width: 18%;
        }

        .link-container {
            width: 30%;
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
        }

        .link-container a button {
            background: #198754;
            border-radius: 5px;
            cursor: pointer;
            color: #FFFFFF;
            border: none;
            height: 50px;
            width: 170%;
            padding: 3%;
        }
        #open-voting-panel:hover {
            -webkit-box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.75);
            -moz-box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.75);
            box-shadow: 0px 0px 8px 0px rgba(0,0,0,0.75);
        }
    </style>



    <div class="main-content">
        <div class="heading">
            <h3>SUB eVoting System</h3>
        </div>
        <div class="body">
            <div class="club-logo">
                <img src="img/club-logo.png" alt="">
            </div>
            <h2>Welcome To SUB eVoting System</h2>
            <h2><?=$votername?></h2>
            <div class="link-container text-center">
                <a href="voting-panel.php" style="margin-left: -34%"><button id="open-voting-panel"><b>Open Voting Panel-></b></button></a>
            </div>
        </div>
    </div>
</div>
<?php include "./copyright.php"?>
<?php include 'footer.php'?>
<?php if (!empty($_SESSION['voter_success_msg'])) { ?>
    <script>
        Toastify({
            text: '<?=$_SESSION['voter_success_msg']?>',
            duration: 3000, // Display duration in milliseconds (3 seconds in this example)
            gravity: "top", // Toast position (top, bottom, center)
            position: "center", // Toast position (left, center, right)
            close: true, // Show close button
            backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)", // Customize background color
            stopOnFocus: true, // Stop hiding the toast when the user focuses on it
        }).showToast();
    </script>
<?php } ?>

<?php
unset($_SESSION['voter_success_msg']);
unset($_SESSION['change_password']);
unset($_SESSION['forgot-pass']);
?>
