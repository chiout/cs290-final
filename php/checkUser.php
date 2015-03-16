<?php

// this will check to see if an username is already taken during account registration

require("../../cred.php");

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
/*
http://php.net/manual/en/mysqli-result.num-rows.php
num_rows usage based on Example #1, Row 13
*/

if ($entries > 0) {
	echo "taken";
}

if ($entries <= 0) {
	echo "available";
}

$checkUser->close();

/*
all prepared statements used in the php files in this website are based on prepared statements format found here:
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php (primarily examples 1, 2, 6)
*/