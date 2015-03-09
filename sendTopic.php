<?php

// this page will send the topic name to the database

$tName = $_GET['name'];
$tName = strtolower($tName);
$tName = ucfirst($tName);

$username = $_GET['user'];

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error adding topic';
} // this connects to the database

if (!($sendTopic = $connect->prepare("INSERT INTO topics(name, author) VALUES (?,?)"))) {
  echo 'Error adding topic';
}

if (!($sendTopic->bind_param("ss", $tName, $username))) {
  echo 'Error adding topic';
}

if (!($sendTopic->execute())) {
  echo 'Error adding topic';
}

$sendTopic->close();

// responds to the AJAX call and sends the topic information to the database