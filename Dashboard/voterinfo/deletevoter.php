<?php
include 'db.php';
if(isset($_POST['voterdeletesend'])){
   
    $voterid = $_POST['voterdeletesend'];

    $sql="delete from `voterinfo` where voterid='{$voterid}'";
    $result=mysqli_query($conn,$sql);
}
?>
