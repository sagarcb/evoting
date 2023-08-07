<style>
    /* Custom background color */
    .custom-navbar {
        background-color: #fffcf5 !important; /* Change this to your desired background color */
        border: 1px solid #eeebeb;
        margin-bottom: 5px;
    }

    /* Custom font color */
    .custom-navbar .navbar-nav .nav-link {
        color: #198754 !important; /* Change this to your desired font color */
    }
    .navbar-brand img {
        width: 50%;
        margin-left: 0;
    }
    .nav-item .nav-link {
        font-size: large;
        font-weight: bold;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark custom-navbar">
    <a class="navbar-brand" href="dashboard.php"><img src="https://upload.wikimedia.org/wikipedia/en/3/3b/SUB-Logo-with-name.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="php/voterlogout.php?logout_id=<?php error_reporting(0);echo $voterid;?>">Log Out</a>
            </li>
        </ul>
    </div>
</nav>