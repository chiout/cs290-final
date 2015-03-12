<?php

// this will retrieve user information from the database

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
	  echo 'Error retrieving user info';
} // this connects to the database

if (!($retUser = $connect->prepare("SELECT first, last, age, bio FROM credentials WHERE user=(?)"))) {
  echo 'Error retrieving user info';
}

if (!($retUser->bind_param('s', $username))) {
  echo 'Error retrieving user info';
}

if (!($retUser->execute())) {
  echo 'Error retrieving user info';
}

if (!($retUser->bind_result($fName, $lName, $age, $bio))) {
  echo "Error retrieving user info";
}

$retUser->fetch();

$retUser->close();

if ($age == null) {
	$age = "N/A";
}

if ($bio == null) {
	$bio = "N/A";
}

echo "<br>
		<span id=\"pName\">Name:</span> 
		<span id=\"pInfo\">$fName $lName</span>
		<br><br>
		<span id=\"pName\">Username:</span> 
		<span id=\"pInfo\">$username</span>
		<br><br>
		<span id=\"pName\">Age:</span> 
		<span id=\"pInfo\">$age</span>
		<br><br>
		<span id=\"pName\">Biography:</span> 
		<span id=\"pInfo\">$bio</span>";


