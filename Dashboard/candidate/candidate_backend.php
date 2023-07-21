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

        $candidateid = rand(1000000,9999999);
        $sql = "insert into `candidateinfo`(candidateid,candidatename,candidatemail,batch,postid) values('$candidateid','$nameSend','$emailSend','$batchSend','$posttSend')";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            $response = [
                'status' => true
            ];
        }else {
            $response = [
                'status' => 'false',
                'msg' => 'Something went wrong. Please try again'
            ];
        }
        json_encode($response);
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
        $candidateName = $_POST['data']['candidatename'];
        $candidateEmail = $_POST['data']['candidatemail'];
        $candidateBatch = $_POST['data']['batch'];
        $postid = $_POST['data']['postid'];
        $candidateId = $_POST['candidateId'];
        $sql = "UPDATE `candidateinfo`
                SET candidatename = '$candidateName',
                candidatemail = '$candidateEmail',
                batch = '$candidateBatch',
                postid = '$postid'
            WHERE candidateid = '$candidateId';";
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