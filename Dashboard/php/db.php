<?php

$conn = new mysqli('localhost', 'root', '', 'evoting');
if (!$conn . mysqli_connect_error()) {
    echo "Connection Denied";
}


?>