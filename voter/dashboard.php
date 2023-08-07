<?php include 'unauthenticated_redirection.php'?>
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

        .link-container {
            width: 30%;
            margin-top: 5%;
            margin-left: auto;
            margin-right: auto;
        }

        .link-container a button {
            border: 1px solid grey;
            cursor: pointer;
        }
    </style>



    <div class="main-content">
        <h2>Welcome</h2>
        <h2><?=$votername?></h2>
        <div class="link-container d-flex justify-content-between">
            <a href="voting-panel.php"><button>Open Voting Panel</button></a>
            <a href="change-password.php"><button>Change Password</button></a>
        </div>
    </div>
</div>
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
?>
