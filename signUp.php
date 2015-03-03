<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="styling.css">
		<script>
			angular.module("signUpForm", []).controller("signUpFormCtrl", function ($scope, $http) {

				$scope.person = {};
				$scope.notReg = true;

				$scope.submitted = function () {
					$scope.notReg = false;
					// this will hide the form once its been submitted and reveal the thank you message
				}

			});
		</script>
<?php
require("accounts.php"); // include the code that adds the form elements to the database
?>
	</head>
	<body class="background" ng-app="signUpForm">
		<div class="header">
			<!--navigation goes here -->
		</div>
		<div id="contentBoxSignUp" ng-controller="signUpFormCtrl">
			<div id="content">
				<div ng-show="notReg">
					<h2>Message Board Sign Up</h2>
					<p class="message">
						Please sign up for an account below. 
						<br> All fields are required; you will not be able to submit the form without filling out all of the fields.
						<br>
						<ul class="message">
							<li>Please keep usernames to a maximum of 8 characters. They must include an alphabet letter.
							<li>Your password must be between 6-10 characters long.</li>
							<li>If your text turns red, that means your input is not valid.</li>
						</ul>
					</p>
					<form name="signUp" class="sIForm" id="signUp" method="POST" action="signUp.php" novalidate>
						<p class="block">
							<label for="fName" class="sILabel">First Name:</label>
							<input class="sIField" type="text" id="fName" ng-model="person.first" name="first" required>
						<p class="block">
							<label for="lName" class="sILabel">Last Name:</label>
							<input class="sIField" type="text" id="lName" ng-model="person.last" name="last" required>
						<p class="block">
							<label for="username" class="sILabel">Username:</label>
							<input class="sIField" name="username" type="text" id="username" ng-model="person.username" ng-maxlength="8" ng-pattern="/[a-z]/" required>
						<p class="block">
							<label for="password" class="sILabel">Password:</label>
							<input class="sIField" type="password" name="pword" id="password" ng-model="person.password" ng-minlength="6" ng-maxlength="10" required>
						<p class="block">
							<button type="submit" id="signUpButton" ng-disabled="signUp.$invalid" ng-click="submitted()">Sign Up</button>
						</p>
					</form>
				</div>
				<div ng-show="notReg">
					<h2>Message Board Sign Up</h2>
					<p class="message">
						Thank you for registering! Please go back to the <a href="index.html">homepage</a> to sign in!
					</p>
				</div>
			</div>
		</div>
	</body>
</html>
