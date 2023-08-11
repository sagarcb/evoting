<style>
    /* Custom background color */
    .custom-navbar {
        background-color: #FFFFFF !important; /* Change this to your desired background color */
    }

    /* Custom font color */
    .custom-navbar .navbar-nav .nav-link {
        color: #198754 !important; /* Change this to your desired font color */
    }
    /*.navbar-brand img {*/
    /*    width: 50%;*/
    /*    margin-left: 0;*/
    /*}*/
    .nav-item .nav-link {
        font-size: medium;
        font-weight: bold;
    }

    .nav-item .nav-link:hover {
        background: #efefef;
    }

    .navbar-brand {
        ;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
    <a class="navbar-brand" href="/evoting/voter/dashboard.php"><img src="https://www.sub.ac.bd/uploads/logo/cdcbff91d69b664eef72.jpg" width="200" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="change-password.php">Change-Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="php/voterlogout.php?logout_id=<?php error_reporting(0);echo $voterid;?>">Log Out</a>
            </li>
        </ul>
    </div>
</nav>