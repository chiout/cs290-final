<?php

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo "Your sign up failed. Please try again.";
} // this connects to the database

$fName = $_POST['first'];
$lName = $_POST['last'];
$username = $_POST['username'];
$word = $_POST['pword'];

if ($fName) {

	if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
	  echo '<div id="content"><p class="message">Your signup failed. Please try again.</p></div>';
	}

	if (!($addUser->bind_param("ssss", $fName, $lName, $username, $word))) {
	  echo '<div id="content"><p class="message">Your signup failed. Please try again.</p></div>';
	}

	if (!($addUser->execute())) {
	  echo '<div id="content"><p class="message">Your signup was unsuccessful. Please try another username.</p></div>';
	} else {
	  echo '<div id="content"><p class="message">Thank you for registering! Please go back to the <a href="index.html">homepage</a> to sign in!</p></div>';
	}

	$addUser->close();

	$fName = null;

}


