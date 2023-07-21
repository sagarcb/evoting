<?php
include 'db.php';


extract($_POST);

if (isset($_POST['nameSend']) && isset($_POST['emailSend']) && isset($_POST['batchSend']) && isset($_POST['posttSend'])) {



        $sql = "insert into `candidateinfo`(candidateid,candidatename,candidatemail,batch,posttype) values('$candidateid','$nameSend','$emailSend','$batchSend','$posttSend')";


        $res = mysqli_query($conn, $sql);


}