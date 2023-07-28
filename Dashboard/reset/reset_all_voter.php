<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->resetAllCastedVote() && $resetClass->resetAllVoteCastInfoToNotCasted()){
    $_SESSION['success_msg'] = 'All Voters Data reset completed!';

}else {
    $_SESSION['error_msg'] = 'Failed to reset Voters Data!';
}

header('location:/evoting/Dashboard/dashboard.php');