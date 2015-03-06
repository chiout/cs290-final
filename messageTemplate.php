<!DOCTYPE html>

<html>
	<head>
		<meta charset="UTF-8">
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
		<link href='http://fonts.googleapis.com/css?family=Muli:300,400|Roboto:400,300,700,900,500|Pontano+Sans' rel='stylesheet' type='text/css'>
		<LINK type="text/css" rel="stylesheet" href="styling.css">
		<script>
			angular.module("dashboardMod", []).controller("dashboardModCtrl", function ($scope, $http) {

				$scope.person = {};

			});
		</script>
	</head>
	<body class="background" ng-app="dashboardMod">
		<div class="header">
			<!--navigation goes here -->
		</div>
		<div id="dashboardBox" ng-controller="dashboardModCtrl">
			<div id="dashContent">
				<h2>Message Board</h2>
				<span class="message">
					<div id="dashBlockTopic">Topic Name</div>
				</span>
				<span class="message">
					Topic Description goes here
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
					<form name="addMessage" method="POST" action="dashboard.html">
						<textarea name="newMessage" id="nMessage"></textarea>
						<button type="submit" id="postButton">Post</button>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
