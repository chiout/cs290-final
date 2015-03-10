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
/*if (!isset($_SESSION['newTopic'])) {
	$_SESSION['newTopic'] = $_POST['startField'];
}*/
require ("getInfo.php");
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="styling.css">
		<script src="submitMessage.js"></script>
		<script>
			var author = <?php echo json_encode($topicAuth); ?>;
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
				<a href="dashboard.php?logout=1">Logout</a>
			</div>
			<div class="nav">
				<?php echo $_SESSION['user']; ?>
			</div>
		</div>
		<div id="dashboardBox">
			<div id="dashContent">
				<h2>Message Board</h2>
				<span class="message">
					<div id="dashBlockTopic"><?php echo $topicName; ?></div>
				</span>
				<span class="message">
					<?php echo "Started by ".$topicAuth; ?>
				</span>
<!--below will be the code for each message -->
<?php
require ("getMessages.php");
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
