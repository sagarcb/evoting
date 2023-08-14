<?php
error_reporting(0);
session_start();
include 'php/db.php';

$voterid = $_SESSION['voterid'];
$votername = $_SESSION['votername'];
if (!isset($_SESSION['voterid']) && !isset($_SESSION['votername'])) {
    header("Location:/evoting/voter/index.php");
}
