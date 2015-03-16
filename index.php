<?php
session_start();
$filePath = explode('/', $_SERVER['PHP_SELF'],-1);
$filePath = implode('/', $filePath);
$redirect = "http://".$_SERVER['HTTP_HOST'].$filePath;
/*
The three lines of code above are taken from the "PHP Sessions" video for this class
They are from lines 10-12 in the video
*/
$dash = $redirect."/dashboard.php";
if(isset($_SESSION['user'])) {
	header("Location: $dash", true);
} // if the session already exists, this should redirect to the dashboard page
// this prevents errors caused by logging in when a session is already occuring

if (!isset($_SESSION['user'])) {
	session_destroy();
	// destroys session if one has not yet been started via logging in
}

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<script src="js/verifyLogin.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="css/styling.css">
		<title>Message Board</title>
		<script>
			angular.module("signInForm", []).controller("signInFormCtrl", function ($scope, $location) {
				$scope.user= {}; // declare the empty object
				// purpose of Angular JS is to do immediate form validation
				// the sign in button will not activate unless all the input is valid
				// the text will turn red to visually let the user know that the input is not valid
			});
		</script>
	</head>
	<body class="background" ng-app="signInForm">
		<div class="header">
			<!--empty navigation -->
		</div>
		<div id="contentBox">
			<div id="content" ng-controller="signInFormCtrl">
				<h2>Message Board Login</h2>
				<p class="message">Please enter your username and password to sign in.</p>
				<p id="errorMessage" class="hidden">Please re-enter your login credentials.</p>	
				<!-- This will only appear if AJAX's PHP feedback is "invalid" -->
				<form name="signIn" class="sIForm" novalidate>
					<p class="block">
						<label for="username" class="sILabel">Username:</label>
						<input class="sIField" type="text" id="username" ng-model="user.username" ng-maxlength="10" required>
					<p class="block">
						<label for="password" class="sILabel">Password:</label>
						<input class="sIField" type="password" id="password" ng-model="user.secret" ng-maxlength="15" required>
					<p class="block">
						<button type="button" id="logInButton" onclick="checkLogin()" ng-disabled="signIn.$invalid">Log In</button>
						<!-- The log in button will not activate unless username and password are of the right lenghts -->
						<button type="button" id="signUpButton" onclick="window.location='signUp.php';">Sign Up</button>
						<!-- This button links to the sign up page -->
					</p>
				</form>
			</div>
		</div>
	</body>
</html>