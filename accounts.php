<?php

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo "Connection failed: $connect->connect_errno \n";
} // this connects to the database

$fName = $_POST['firstName'];
$lName = $_POST['lastName'];
$username = $_POST['username'];
$word = $_POST['password'];

echo $_POST['username'];

if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
  echo "Prep error";
}

if (!($addUser->bind_param("ssss", $fName, $lName, $username, $word))) {
  echo "Param error";
}

if (!($addUser->execute())) {
  echo "Execution error";
} else {
  echo "Done!";
}

$addUser->close();


