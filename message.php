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
/*if (!isset($_SESSION['newTopic'])) {
	$_SESSION['newTopic'] = $_POST['startField'];
}*/

if (!isset($_SESSION['user'])) {
	session_destroy();
  	header("Location: $home", true);
  	die();
} // if user is not logged in, then this will redirect back to the login page

if(isset($_GET['selection'])) {
	$_SESSION['sel'] = $_GET['selection'];
}
// if GET gets a new input, then $_SESSION['sel'] is set equal to the new value
// otherwise when the messages page gets a refresh, it keeps the same topic page

$id = $_SESSION['sel'];

require ("php/getExistingInfo.php"); // pull information based on the topic ID
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="css/styling.css">
		<script src="js/submitMessage.js"></script>
		<script>
			var author = <?php echo json_encode($_SESSION['user']); ?>;
			var topicId = <?php echo json_encode($id); ?>;
			// console.log(topicN);
			// this gets the values from the PHP variables which fetched the data from the topics table

			function show() {
				console.log(document.getElementById("nMessage").value);
		    }
		</script>
	</head>
	<body class="background">
		<div class="header">
			<div class="nav">
				<a href="message.php?logout=1">Logout</a>
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
				</span> <!-- now users can look up other users by clicking on their username -->
<!--below will be the code for each message -->
<?php
require ("php/getMessages.php");
?>
				<!--<div class="writerBlock">

					<div class="bName">Name</div>
					<div class="bDate">Date</div>
					<div class="messageBlock">
						message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block 
					</div>
				</div>-->
<!--below is the code for the form-->
				<div id="responseBlock">
					<div class="bDate">When posting, please do not spam the forum and please keep language appropriate for all audiences. Happy discussing!</div>
					<form name="addMessage">
						<textarea name="newMessage" id="nMessage" onblur="show()"></textarea>
						<button id="postButton" onclick="submitMessage()">Post</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
