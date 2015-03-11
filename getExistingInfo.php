<?php
// this will get the topic information from the database that matches the ID that we want 
// this is for the message page for topics that are selected

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
	  echo 'Error retrieving info';
} // this connects to the database

if (!($retInfo = $connect->prepare("SELECT name, author FROM topics WHERE id=(?)"))) {
  echo 'Error retrieving info';
}

if (!($retInfo->bind_param("i", $id))) {
  echo 'Error retrieving info';
}

if (!($retInfo->execute())) {
  echo 'Error retrieving info';
}

if (!($retInfo->bind_result($topicName, $topicAuth))) {
  echo "Error retrieving info";
}

$retInfo->fetch();

$retInfo->close();