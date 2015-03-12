<?php

// this will retrieve user information from the database

require("../cred.php");

if (isset($_POST['age']) || isset($_POST['bio'])) {
	$nAge = $_POST['age'];
	$nBio = $_POST['bio'];


	$connect = new mysqli($host, $user, $pd, $db);
	if ($connect->connect_errno) {
		  echo 'Error updating user info1';
	} // this connects to the database

	if (!($addUserInfo = $connect->prepare("UPDATE credentials SET age=(?),bio=(?) WHERE user=(?)"))) {
	  echo 'Error updating user info2';
	}

	if (!($addUserInfo->bind_param('iss', $nAge, $nBio, $username))) {
	  echo 'Error updating user info3';
	}

	if (!($addUserInfo->execute())) {
	  echo 'Error updating user info4';
	}

	$retUser->close();

}

// once the post request is submitted, then the age and bio are added to the database



