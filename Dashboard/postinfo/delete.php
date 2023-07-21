<?php
include 'db.php';
if(isset($_POST['deletesend'])){
   
    $postid = $_POST['deletesend'];

    $sql="delete from `postinfo` where postid='{$postid}'";
    $result=mysqli_query($conn,$sql);
}
?>
