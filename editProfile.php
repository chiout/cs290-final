<?php
session_start();
$filePath = explode('/', $_SERVER['PHP_SELF'],-1);
$filePath = implode('/', $filePath);
$redirect = "http://".$_SERVER['HTTP_HOST'].$filePath;
/*
The three lines of code above are taken from the "PHP Sessions" video for this class
They are from lines 10-12 in the video
*/
$home = $redirect."/index.html";
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

$username = $_SESSION['user']; // continues the session
// assign php variable to the username

require('php/addUserInfo.php'); // this will add user info to the database once the form is filled out
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="css/styling.css">
		<script src="sendTopic.js"></script>
		<script>
			var user = <?php echo json_encode($username); ?>;
			/* got this code from http://stackoverflow.com/questions/18520247/cant-pass-php-session-variable-to-javascript-string-variable
			Brian Phillip's code, line 1 */
			// this allows Javascipt to take the value of a php variable
			console.log(user);
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
		<div id="profileBox">
			<div id="dashContent" style="overflow:hidden">
				<!-- found this code here: http://stackoverflow.com/questions/1844207/how-to-make-a-div-to-wrap-two-float-divs-inside, Mikael S's code, line 1-->
				<h2>Your Information</h2>
				<div class="message">
					Below is the contact information we have for you. To add/edit your age and biography, please fill out the form below.
				</div>
<?php
require('php/getUserData.php'); // this will fetch the signed in user's data
?>
				<hr>
				<form name="addInfoForm" method="POST" action="editProfile.php">
					<p class="block">
						<label for="age" class="sILabel">Age:</label>
						<input class="sIField" type="number" id="age" name="age">
					<p class="block">
						<label for="bio" class="sILabel">Bio:</label>
						<textarea class="sIField" id="bio" name="bio"></textarea>
					<button type="submit" id="editButton">Add Information</button>
				</form>
				<!-- decided not to use AJAX since this should require a page refresh so users can see that something has happened -->
		</div>
	</body>
</html>