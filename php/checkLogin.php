<?php

// this will retrieve the hashed password of the corresponding username
// the hashed password will then be compared with the entered password

$uWord = $_POST['user'];
$pWord = $_POST['value'];

require("../../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error verifying username';
} // this connects to the database

if (!($checkLog = $connect->prepare("SELECT word FROM credentials WHERE user = (?)"))) {
  echo 'Error verifying username';
}

if (!($checkLog->bind_param("s", $uWord))) {
  echo 'Error verifying username';
}

if (!($checkLog->execute())) {
  echo 'Error verifying username';
}

if (!($checkLog->bind_result($word))) {
  echo "Error verifying username";
}

$checkLog->fetch();


if ($word != null) {
	if (password_verify($pWord, $word)) {
		echo "valid";
		session_start(); // this will begin the session
		$uWord = strtolower($uWord);
		$_SESSION['user'] = $uWord;
	} else {
		echo "invalid";
	}
} else {
	echo "invalid";
}

/*
Password verification code:
http://php.net/manual/en/function.password-verify.php
Based on lines 3-8
*/

$checkLog->close();

/*
all prepared statements used in the php files in this website are based on prepared statements format found here:
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php (primarily examples 1, 2, 6)
*/