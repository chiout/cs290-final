<?php

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo "Connection failed: $connect->connect_errno \n";
} // this connects to the database

$userData = file_get_contents("php://input");
$user = json_decode($userData);

$fName = $user->first;
$lName = $user->last;
$username = $user->username;
$word = $user->password;

if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
  echo "Prep error";
}

if (!($addUser->bind_param("ssss", $fName, $lName, $username, $word))) {
  echo "Param error";
}

if (!($addUser->execute())) {
  echo "Execution error";
} else {


}

$addUser->close();




