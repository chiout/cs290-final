<?php

$uWord = $_GET['user'];
$pWord = $_GET['value'];

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error verifying username';
} // this connects to the database

if (!($checkLog = $connect->prepare("SELECT *FROM credentials WHERE (user, word) = (?,?)"))) {
  echo 'Error verifying username';
}

if (!($checkLog->bind_param("ss", $uWord, $pWord))) {
  echo 'Error verifying username';
}

if (!($checkLog->execute())) {
  echo 'Error verifying username';
}

$checkLog->store_result();

$entries = $checkLog->num_rows;

if ($entries > 0) {
	echo "valid";
	session_start(); // this will begin the session
	$_SESSION['user'] = $uWord;
}

if ($entries <= 0) {
	echo "invalid";
}

$checkLog->close();