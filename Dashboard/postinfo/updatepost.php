<?php
include 'db.php';
if (isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];

    $sql="select * from `postinfo` where postid=$user_id";
    $result=mysqli_query($conn,$sql);
    $response=array();
    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message'] = "Invalid";
}



///update query
if (isset($_POST['hiddendata'])){
    $unique_id=$_POST['hiddendata'];
    $num=$_POST['updatenum'];
    $post=$_POST['updatepost'];
    $des=$_POST['updatedesc'];
    $multiple_person=$_POST['multiple_person'];

    $sql="update `postinfo` set numberofseat='$num',posttype='$post',postdescription='$des',multiple_person='$multiple_person' where postid=$unique_id";
    $result=mysqli_query($conn,$sql);

}
?>