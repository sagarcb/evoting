<?php
session_start();

include 'ResetDataClass.php';

$ballotNo = $_POST['ballot_no'];
$voterId = $_POST['voter_id'];

if (isset($ballotNo) && isset($voterId)) {
    $resetClass = new ResetDataClass();
    if ($resetClass->deleteBallotPaperInfo($ballotNo, $voterId) && $resetClass->resetVoterInfoToNotCasted($voterId)){
        $_SESSION['success_msg'] = 'Data Reset Successful';

    }else {
        $_SESSION['error_msg'] = 'Failed to reset Single Vote Cast';
    }
}else {
    $_SERVER['error_msg'] = 'Ballot No. or Voter ID cannot be empty!';
}

header('location:/evoting/Dashboard/dashboard.php');