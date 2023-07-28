<?php
session_start();

include 'ResetDataClass.php';

$resetClass = new ResetDataClass();
if ($resetClass->resetAllCastedVote()){
    $_SESSION['success_msg'] = 'All casted vote reset completed!';

}else {
    $_SESSION['error_msg'] = 'Failed to reset All Casted Vote!';
}

header('location:/evoting/Dashboard/dashboard.php');