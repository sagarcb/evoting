<?php
include 'db.php';

extract($_POST);

if (isset($_POST['numSend']) && isset($_POST['postSend']) && isset($_POST['descSend'])) {

    $postid =rand(time(), 10000000);
   

    $sql = "insert into `postinfo`(postid,numberofseat,posttype,postdescription) values('$postid','$numSend','$postSend','$descSend')";

    $result = mysqli_query($conn, $sql);
    
}

?>