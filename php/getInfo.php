<?php
// this will get the most recent topic information from the database - i.e. the most recent row (with largest id)
// this is for the message page after a user starts a new topic

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
	  echo 'Error retrieving info';
} // this connects to the database

if (!($retInfo = $connect->prepare("SELECT id, name, author FROM topics WHERE id=(SELECT max(id) FROM topics)"))) {
  echo 'Error retrieving info';
}

if (!($retInfo->execute())) {
  echo 'Error retrieving info';
}

if (!($retInfo->bind_result($id, $topicName, $topicAuth))) {
  echo "Error retrieving info";
}

$retInfo->fetch();

$retInfo->close();