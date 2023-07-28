<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->resetAllCastedVote() && $resetClass->candidateReset() && $resetClass->resetPost()){
    $_SESSION['success_msg'] = 'All Posts reset completed!';

}else {
    $_SESSION['error_msg'] = 'Failed to reset Posts Data!';
}

header('location:/evoting/Dashboard/dashboard.php');