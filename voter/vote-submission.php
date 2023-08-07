<?php
session_start();
include_once "php/db.php";
$response = [];
if (!empty($_POST) && !empty($_POST['data'])) {
    $voter_id = $_POST['voter_id'];
    $login_email = $_POST['loginemail'];
    $checkLoginEmail = checkLoginEmail($login_email, $voter_id, $conn);
    if (!$checkLoginEmail) {
        $response = [
            'status' => false,
            'msg' => 'Your submitted email and Login email did not match! Please enter the correct email address.'
        ];
        echo json_encode($response);
        die();
    }

    $total = count($_POST['data']);
    foreach ($_POST['data'] as $key => $data) {
        $response = singlePostVoteSubmission($data, $conn);
        if (!$response['status']) {
            break;
        }
        if ($total - 1 == $key) {
            sendEmail($voter_id, $conn, $response['ballotNumber']);
        }
    }
}else {
    $response = [
        'status' => false,
        'msg' => 'Something went wrong!'
    ];
}
echo json_encode($response);
exit();
function singlePostVoteSubmission($data, $conn) {
    if (!empty($data['candidateid']) && !empty($data['postid']) && !empty($data['voterid'])) {
        $can_id = $data['candidateid'];
        $post_id = $data['postid'];
        $voter_id = $data['voterid'];

        $ballot_number = time() + rand(1000,9999);
        $ballotPaperInfoTableInsertQuery = "INSERT INTO `ballotpaperinfo`(ballotnumber, voterid) VALUES ('$ballot_number',$voter_id)";
        $result = mysqli_query($conn, $ballotPaperInfoTableInsertQuery);
        if ($result) {
            $voteCastInfoTableInsertQuery = "INSERT INTO `votecastinfo`(ballotnumber, candidateid, postid) VALUES ('$ballot_number','$can_id','$post_id')";
            $result1 = mysqli_query($conn, $voteCastInfoTableInsertQuery);
            if ($result1) {
                $updateVoteCastStatusQuery = "UPDATE `voterinfo` SET votecaststatus = 1 WHERE voterid='$voter_id'";
                $result2 = mysqli_query($conn, $updateVoteCastStatusQuery);
                if ($result2) {
                    $_SESSION['voter_success_msg'] = 'Your vote has been submitted successfully!';
                    $response = [
                        'status' => true,
                        'msg' => 'Vote added successfully',
                        'ballotNumber' => $ballot_number
                    ];
                }else {
                    $response = [
                        'status' => false,
                        'msg' => 'Failed to submit vote!'
                    ];
                }
            }else {
                $response = [
                    'status' => false,
                    'msg' => 'Failed to submit vote!'
                ];
            }
        }else {
            $response = [
                'status' => false,
                'msg' => 'Failed to submit vote!'
            ];
        }
    }else {
        $response = [
            'status' => false,
            'msg' => 'Failed to submit vote!'
        ];
    }
    return $response;
}

function sendEmail($voterid, $conn, $ballotPaperNumber) {
    $query = "SELECT * FROM `voterinfo` WHERE voterid='$voterid'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data) {
        $receiver = $data['email'];
        $subject = "Vote submission confirmation";
        $body = "Hello " . $data['votername'] . ", \n Your vote has been submitted successfully!!
         \n Ballot Paper Number: $ballotPaperNumber \nSincerely, \n SUB";
        $sender = "From: shonpollock0@gmail.com";

        if (mail($receiver, $subject, $body, $sender)) {
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function checkLoginEmail($loginEmail, $voterid, $conn) {
    $query = "SELECT * FROM `voterinfo` WHERE voterid='$voterid'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    if ($data && $data['email'] == $loginEmail) {
       return true;
    }
    return false;
}