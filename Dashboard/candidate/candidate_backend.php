<?php
include '../../php/db.php';


extract($_POST);

if (isset($_POST['candidateAdd']) && $_POST['candidateAdd']) {
    if (isset($_POST['nameSend']) && isset($_POST['emailSend']) && isset($_POST['batchSend']) && isset($_POST['posttSend'])) {
        $candidateEmail = $_POST['emailSend'];
        $sql = "SELECT * FROM `candidateinfo` where candidatemail='$emailSend'";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_all();
        if (count($data) > 0) {
            $response = [
                'status' => false,
                'msg'    => 'This email is already exist'
            ];
            echo json_encode($response);
            exit();
        }
        $candidateid = time();
        $imageName = '';
        if ($_FILES) {
            $imageName = uploadImage($_FILES);
        }

        $sql = "insert into `candidateinfo`(candidateid,candidatename,candidatemail,batch,postid,candidateimage) values('$candidateid','$nameSend','$emailSend','$batchSend','$posttSend','$imageName')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $response = [
                'status' => true
            ];
            echo json_encode($response);
            exit();
        }else {
            $response = [
                'status' => 'false',
                'msg' => 'Something went wrong. Please try again'
            ];
        }
        echo json_encode($response);
        exit();

    }else {
        $response = [
            'status' => false,
            'msg' => 'All the fields are required'
        ];
        echo json_encode($response);
        exit();
    }
}


if (isset($_POST['deleteCandidate']) && isset($_POST['candidateId'])) {
    $candidateid = $_POST['candidateId'];
    removeOldCandidateImage($candidateid, $conn);
    $sql = "DELETE FROM `candidateinfo` WHERE candidateid = '$candidateid'";
    $res = mysqli_query($conn, $sql);
    if ($res) echo true;
    else echo false;
    exit();
}

if (isset($_POST['getCandidateInfo']) && isset($_POST['candidateId'])) {
    $candidateid = $_POST['candidateId'];
    $sql = "SELECT * FROM `candidateinfo` where candidateid = '$candidateid'";
    $result = mysqli_query($conn, $sql);
    $data = $result->fetch_assoc();
    if ($data) {
        $data = array($data);
        $response = [
            'status' => true,
            'data' => $data[0]
        ];
    }else {
        $response = [
            'status' => false,
            'Data not found'
        ];
    }
    echo json_encode($response);
    exit();
}

if (isset($_POST['updateCandidate'])) {
    if (isset($_POST['candidateId'])) {
        $candidateName = $_POST['candidatename'];
        $candidateEmail = $_POST['candidatemail'];
        $candidateBatch = $_POST['batch'];
        $postid = $_POST['postid'];
        $candidateId = $_POST['candidateId'];
        $imageName = null;
        if ($_FILES) {
            removeOldCandidateImage($candidateId, $conn);
            $imageName = uploadImage($_FILES);
        }

        if ($imageName) {
            $sql = "UPDATE `candidateinfo`
                SET candidatename = '$candidateName',
                candidatemail = '$candidateEmail',
                batch = '$candidateBatch',
                postid = '$postid',
                candidateimage = '$imageName'
            WHERE candidateid = '$candidateId';";
        }else {
            $sql = "UPDATE `candidateinfo`
                SET candidatename = '$candidateName',
                candidatemail = '$candidateEmail',
                batch = '$candidateBatch',
                postid = '$postid'
            WHERE candidateid = '$candidateId';";
        }
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $response = [
                'status' => true,
            ];
        }else {
            $response = [
                'status' => false,
                'Failed to update'
            ];
        }
    }else {
        $response = [
            'status' => false,
            'Candidate ID is missing'
        ];
    }
    echo json_encode($response);
    exit();

}

function uploadImage($image) {
    $fileName = time().'_'.$image["image"]["name"];
    $targetDir = "./candidate_images/";
    $targetFile = $targetDir . $fileName;
    move_uploaded_file($image["image"]["tmp_name"], $targetFile);
    return $fileName;
}

function removeOldCandidateImage($id, $conn) {
    $query = "SELECT * FROM `candidateinfo` where candidateid = '$id'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    $imageName = $data['candidateimage'];
    unlink('./candidate_images/'.$imageName);
}