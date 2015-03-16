<?php
session_start();
$filePath = explode('/', $_SERVER['PHP_SELF'],-1);
$filePath = implode('/', $filePath);
$redirect = "http://".$_SERVER['HTTP_HOST'].$filePath;
/*
The three lines of code above are taken from the "PHP Sessions" video for this class
They are from lines 10-12 in the video
*/
$home = $redirect."/index.php";
if ((isset($_GET['logout'])) && ($_GET['logout']==1)) {
  $_SESSION = array();
  session_destroy();
  header("Location: $home", true);
  die();
}
/*
destroys session if the GET 'logout' key is given a value of 1
this if block uses the code from lines 8, 9, 13, and 14 from the "PHP Sessions" video
there are some slight modifications I made from the video's code
all code used to end the session in this program uses code from lines 8-9, 14 from the video-
such as the if statement below that checks if $_POST['username'] is an empty string
*/

if (!isset($_SESSION['user'])) {
	session_destroy();
  	header("Location: $home", true);
  	die();
} // if user is not logged in, then this will redirect back to the login page

$username = $_SESSION['user']; // continues the session
// assign php variable to the username

require('php/addUserInfo.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="css/styling.css">
		<title>Edit Profile</title>
		<script>
			angular.module("checkInputMod", []).controller("checkInputCtrl", function ($scope) {
				$scope.fields={};
				// use Google's Hosted AngularJS library to do form validation for the biography
			});
		</script>
	</head>
	<body class="background">
		<div class="header">
			<div class="nav">
				<a href="editProfile.php?logout=1">Logout</a>
			</div>
			<div class="nav">
				<a href="editProfile.php">Profile</a>
			</div>
			<div class="nav">
				<a href="dashboard.php">Dashboard</a>
			</div>
			<div class="nav">
				Welcome <?php echo $username; ?>
			</div>
		</div>
		<div id="profileBox" ng-app="checkInputMod" ng-controller="checkInputCtrl">
			<div id="dashContent" style="overflow:hidden">
				<!-- found this code here: http://stackoverflow.com/questions/1844207/how-to-make-a-div-to-wrap-two-float-divs-inside, Mikael S's code, line 1-->
				<h2>Your Information</h2>
				<p class="message">
					Below is the account information we have for you. To add/edit your age and biography, please fill out the form below.
					Please limit your biography to 500 characters. 
				</p>
<?php
require('php/getUserData.php');
?>
				<hr>
				<p class="message">Both fields are required</p>
				<form name="editProf" method="POST" action="editProfile.php" novalidate>
					<p class="block">
						<label for="age" class="sILabel">Age:</label>
						<input class="sIField" type="number" id="age" name="age" ng-model="fields.age" required>
					<p class="block">
						<label for="bio" class="sILabel">Bio:</label>
						<textarea class="sIField" id="bio" name="bio" ng-maxlength="500" ng-model="fields.bio" required></textarea>
						<!-- If the text is over 500 characters, then the button will deactivate-->
					<button id="editButton" ng-disabled="editProf.$invalid">Add Information</button>
				</form>
				<!-- a page refresh is good for this so we did not use Ajax -->
				<hr>
				<p id="pName">Upload a profile pic/icon</p>
				<p>
					<ul class="message">
					<li>Please keep the file size less than 160kb. It is advisable to keep your image under 200x200 pixels. 
					<li>Only PNG file types are allowed.
					<li>All images will appear resized to 50x50 px.
					<li>Uploading a new picture will override the old one.</li>
					<li>If you do not upload a picture, your default profile picture is below:</li>
					</ul>
					<img style="width:50px; height:50px;" src="../img/default.png" alt="default icon">
				</p>
				<form method="POST" enctype="multipart/form-data" action="editProfile.php">
					<input type="file" name="profPic">
					<!--<input type="submit" name="sub" value="Submit">-->
					<button type="submit" id="editButton">Upload</button>
				</form>
				<p class="message">After you click upload, refresh to see your uploaded icon below.</p>
				<!-- based this code off lines 1-4 of the HTML code found on http://codular.com/php-file-uploads-->
<?php
require('php/imgUpload.php'); // this will handle the image uploads
?>
			</div>
		</div>
		<div class="empty"></div>
	</body>
</html>