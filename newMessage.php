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

if (!isset($_SESSION['user'])) {
	session_destroy();
  	header("Location: $home", true);
  	die();
} // if user is not logged in, then this will redirect back to the login page

require ("php/getInfo.php");
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="css/styling.css">
		<script src="js/submitMessage.js"></script>
		<script>
			var author = <?php echo json_encode($_SESSION['user']); ?>;
			var topicId = <?php echo json_encode($id); ?>;
			// console.log(topicN);
			// this gets the values from the PHP variables which fetched the data from the topics table

		</script>
		<script>
			angular.module("checkNMInput", []).controller("checkNMInputCtrl", function ($scope) {
				$scope.fields={};
				// use Google's Hosted AngularJS library to do form validation for the biography
			});
		</script>
		<title><?php echo $topicName; ?></title>
	</head>
	<body class="background" ng-app="checkNMInput" ng-controller="checkNMInputCtrl">
		<div class="header">
			<div class="nav">
				<a href="newMessage.php?logout=1">Logout</a>
			</div>
			<div class="nav">
				<a href="editProfile.php">Profile</a>
			</div>
			<div class="nav">
				<a href="dashboard.php">Dashboard</a>
			</div>
			<div class="nav">
				Welcome <?php echo $_SESSION['user']; ?>
			</div>
		</div>
		<div id="dashboardBox">
			<div id="dashContent">
				<h2>Message Board</h2>
				<span class="message">
					<div id="dashBlockTopic"><?php echo $topicName; ?></div>
				</span>
				<span class="message">
					<?php echo "Started by <a href=\"user.php?user=$topicAuth\">$topicAuth</a>" ?>
				</span>
<!--below will be the code for each message -->
<?php
require ("php/getMessages.php");
?>
<!--below is the code for the form-->
				<div id="responseBlock">
					<div class="bDate">When posting, please do not spam the forum and please keep language appropriate for all audiences. Happy discussing!
						<br> If your post does not automatically show up, please refresh. 
						<br> Please limit your word count to 700 characters. Happy discussing!</div>
					<form name="addMessage">
						<textarea name="newMessage" id="nMessage" ng-model="fields.message" ng-maxlength="500"></textarea>
						<button id="postButton" onclick="submitMessage()" ng-disabled="addMessage.$invalid">Post</button>
					</form>
				</div>
			</div>
		</div>
		<div class="empty"></div>
	</body>
</html>
