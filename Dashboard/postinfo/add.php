<?php
include 'db.php';

extract($_POST);

if (isset($_POST['numSend']) && isset($_POST['postSend']) && isset($_POST['descSend'])) {

    $postid =rand(time(), 10000000);

    $sql = "insert into `postinfo`(postid,numberofseat,posttype,postdescription,multiple_person) values('$postid','$numSend','$postSend','$descSend','$multiple_person')";

    $result = mysqli_query($conn, $sql);
    
}

?>