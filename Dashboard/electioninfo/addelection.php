<?php
include 'db.php';

extract($_POST);

if (isset($_POST['electiontitle']) && isset($_POST['electionpass']) && isset($_POST['electionstatus'])
&& isset($_POST['starttime']) && isset($_POST['endtime'])) {

   

    $sql = "insert into `electioninfo`(electiontitle,electionpassword,electionstatus,electionstartdatetime,electionenddatetime) values('$electiontitle','$electionpass','$electionstatus','$starttime','$endtime')";

    $result = mysqli_query($conn, $sql);
    
}
?>