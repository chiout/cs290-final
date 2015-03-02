<?php

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo "Connection failed: $connect->connect_errno \n";
} // this connects to the database

if (isset($_POST['first'])) {
  $fName = $_POST['first'];
  $lName = $_POST['last'];
  $user = $_POST['username'];
  $word = $_POST['pword'];

if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
  echo "Prep error";
}

if (!($addUser->bind_param("ssss", $fName, $lName, $user, $word))) {
  echo "Param error";
}

if (!($addUser->execute())) {
  echo "Execution error";
} // add the user if they sign up

$addUser->close();


}

