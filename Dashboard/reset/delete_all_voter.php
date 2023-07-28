<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->resetAllCastedVote() && $resetClass->candidateReset() && $resetClass->deleteAllVoters()){
    $_SESSION['success_msg'] = 'All Voters Data deletion completed!';

}else {
    $_SESSION['error_msg'] = 'Failed to delete Voters Data!';
}

header('location:/evoting/Dashboard/dashboard.php');