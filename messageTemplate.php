<?php
session_start();

if (!isset($_SESSION['newTopic'])) {
	$_SESSION['newTopic'] = $_POST['startField'];
	$user = $_SESSION['user'];
	$topicName = $_SESSION['newTopic'];
}

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="styling.css">
		<script src="submitMessage.js"></script>
		<scipt>
			var author = <?php echo json_encode($_SESSION['user']); ?>;
			var topicN = <?php echo json_encode($_SESSION['newTopic']); ?>;
			console.log(topicN);
		</script>
	</head>
	<body class="background">
		<div class="header">
			<!--navigation goes here -->
		</div>
		<div id="dashboardBox">
			<div id="dashContent">
				<h2>Message Board</h2>
				<span class="message">
					<div id="dashBlockTopic"><?php echo $topicName; ?></div>
				</span>
				<span class="message">
					<?php echo "Started by $user"; ?>
				</span>
<!--below will be the code for each message -->
				<div class="writerBlock">
					<div class="bName"></div>
					<div class="bDate">Date</div>
					<div class="messageBlock">
						message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block message block 
					</div>
				</div>
<!--below is the code for the form-->
				<div id="responseBlock">
					<div class="bDate">When posting, please do not spam the forum and please keep language appropriate for all audiences. Happy discussing!</div>
					<form name="addMessage">
						<textarea name="newMessage" id="nMessage"></textarea>
						<button id="postButton" onclick="submitMessage()">Post</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
