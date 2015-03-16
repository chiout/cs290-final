<?php

// this page adds an user account after the username is verified to not be taken
// this will add another row to the credentials table in the database

/*
all prepared statements used in the php files in this website are based on prepared statements format found here:
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php (primarily examples 1, 2, 6)
*/

require("../cred.php");

$sUClass = '"notHidden"';

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo '<div id="contentBoxSignUp" ng-controller="signUpFormCtrl"><h2>Message Board Sign Up</h2><div id="content"><p class="message">Your sign up failed. Please try again.</p></div></div>';
} // this connects to the database

$fName = $_POST['first'];
$lName = $_POST['last'];
$username = $_POST['username'];
$word = $_POST['pword'];
$word = password_hash($word, PASSWORD_DEFAULT); // hash the password
/* password hashing: based on line 9 found here: http://php.net/manual/en/function.password-hash.php*/
$username = strtolower($username);

$_POST = array(); // clear the post array

if ($fName) {

	$sUClass = '"hidden"';

	if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
	  echo '<div id="contentBoxSignUp" ng-controller="signUpFormCtrl"><div id="content"><h2>Message Board Sign Up</h2><p class="message">Your signup failed. Please try again.</p></div></div>';
	}

	if (!($addUser->bind_param("ssss", $fName, $lName, $username, $word))) {
	  echo '<div id="contentBoxSignUp" ng-controller="signUpFormCtrl"><div id="content"><h2>Message Board Sign Up</h2><p class="message">Your signup failed. Please try again.</p></div></div>';
	}

	if (!($addUser->execute())) {
	  echo '<div id="contentBoxSignUp" ng-controller="signUpFormCtrl"><div id="content"><h2>Message Board Sign Up</h2><p class="message">Your signup was unsuccessful. That username is already taken. Please try again!</p></div></div>';
	} else {
	  echo '<div id="contentBoxSignUp" ng-controller="signUpFormCtrl"><div id="content"><h2>Message Board Sign Up</h2><p class="message">Thank you for registering! Please go back to the <a href="index.php">homepage</a> to sign in!</p></div></div>';
	}

	$addUser->close();

	$fName = null;
	$lName = null;
	$username = null;
	$word = null;
	// resets the variables so it will not keep sensitive data after sign up

}


