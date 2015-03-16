<?php

// this page will send the message to the database along with the topic ID
session_start();

$message= $_GET['mess'];
$topicId = $_GET['top'];
$author = $_GET['auth'];

require("../../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error adding message';
} // this connects to the database

if (!($sendMess = $connect->prepare("INSERT INTO messages(topic, author, message) VALUES (?,?,?)"))) {
  echo 'Error adding message';
}

if (!($sendMess->bind_param("sss", $topicId, $author, $message))) {
  echo 'Error adding message';
}

if (!($sendMess->execute())) {
  echo "Error adding message";
}

$sendMess->close();


// responds to the AJAX call and sends the topic message to the database

/*
all prepared statements used in the php files in this website are based on prepared statements format found here:
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php (primarily examples 1, 2, 6)
*/