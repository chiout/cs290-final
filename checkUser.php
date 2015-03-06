<?php

require("../cred.php");

$username = $_GET['username'];
$usernameExists = null;


$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error verifying username';
} // this connects to the database

if (!($checkUser = $connect->prepare("SELECT *FROM credentials WHERE user = (?)"))) {
  echo 'Error verifying username';
}

if (!($checkUser->bind_param("s", $username))) {
  echo 'Error verifying username';
}

if (!($checkUser->execute())) {
  echo 'Error verifying username';
}

$checkUser->store_result();

$entries = $checkUser->num_rows;

if ($entries > 0) {
	echo "taken";
}

if ($entries <= 0) {
	echo "available";
}
/*
if (!($checkUser->bind_result($usernameExists))) {
      echo "Error verifying username";
    }

if ($usernameExists) {
	echo "taken";
} else {
	echo "available"
}
*/
$checkUser->close();