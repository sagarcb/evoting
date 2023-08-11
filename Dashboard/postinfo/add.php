<?php
include 'db.php';

extract($_POST);

if (isset($_POST['postid']) && isset($_POST['numSend']) && isset($_POST['postSend']) && isset($_POST['descSend'])) {

    $sql = "insert into `postinfo`(postid,numberofseat,posttype,postdescription,multiple_person) values('$postid','$numSend','$postSend','$descSend','$multiple_person')";
    $response = [];
    try {
        $checkIfExist = checkAlreadyExistPostID($conn, $_POST['postid']);
        if ($checkIfExist) {
            $response = [
                'status' => false,
                'msg'    => "You can't use this post id. It is already used"
            ];
            echo json_encode($response);
            die();
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = [
                'status' => true,
                'msg' => "Data saved successfully!"
            ];
            echo json_encode($response);
            die();
        }
    }catch (Exception $exception) {
        $response = [
            'status' => false,
            'msg' => $exception->getMessage()
        ];
        echo json_encode($response);
        die();
    }

}

function checkAlreadyExistPostID($conn, $postid) {
    $sql = "SELECT * FROM `postinfo` WHERE postid='$postid'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    if (!empty($data)) {
        return true;
    }
    return false;
}