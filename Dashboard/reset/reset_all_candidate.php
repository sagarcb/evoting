<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->candidateReset()){
    $_SESSION['success_msg'] = 'All Candidate reset completed!';

}else {
    $_SESSION['error_msg'] = 'Failed to reset Candidate Data!';
}

header('location:/evoting/Dashboard/dashboard.php');