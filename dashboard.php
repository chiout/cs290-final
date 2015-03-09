<?php
session_start();

$username = $_SESSION['user']; // continues the session
// assign php variable to the username
?>
<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="styling.css">
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
			<!--navigation goes here -->
		</div>
		<div id="dashboardBox">
			<div id="dashContent" style="overflow:hidden">
				<!-- found this code here: http://stackoverflow.com/questions/1844207/how-to-make-a-div-to-wrap-two-float-divs-inside, Mikael S's code, line 1-->
				<h2>Message Board Dashboard</h2>
				<div class="message">
					Please either choose an existing forum or start your own topic!
				</div>
				<div id="divBlocks1">
					<div class="headings">Choose an existing topic below:</div>
					<div id="list">
<?php
require('retrieveTopics.php'); //this will retrieve the list of topics as radio buttons
?>
						<button id="chooseButton">Go!</button>
					</div>
				</div>
				<div id="divBlocks2">
					<div class="headings">Start a topic:</div>
					<form name="newTopicForm" method="POST" action="messageTemplate.php">
						<input type="text" id="startField" name="startField">
						<button id="postButton" onclick="send()">Start It!</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
