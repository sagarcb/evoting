<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->resetAllCastedVote() && $resetClass->candidateReset() && $resetClass->resetPost() && $resetClass->voterReset()){
    $_SESSION['success_msg'] = 'All Election Data reset completed!';
}else {
    $_SESSION['error_msg'] = 'Failed to reset Election Data!';
}

header('location:/evoting/Dashboard/dashboard.php');