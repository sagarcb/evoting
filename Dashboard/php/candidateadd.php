<?php
include 'db.php';


extract($_POST);

if (isset($_POST['nameSend']) && isset($_POST['emailSend']) && isset($_POST['batchSend']) && isset($_POST['posttSend'])) {



        $sql = "insert into `candidateinfo`(candidatename,candidatemail,batch,posttype) values('$nameSend','$emailSend','$batchSend','$posttSend')";


        $res = mysqli_query($conn, $sql);


}