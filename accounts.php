<?php

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo "Your sign up failed. Please try again.";
} // this connects to the database

$fName = $_POST['first'];
$lName = $_POST['last'];
$username = $_POST['username'];
$word = $_POST['pword'];

echo $_POST['username'];

if (!($addUser = $connect->prepare("INSERT INTO credentials(first, last, user, word) VALUES (?, ?, ?, ?)"))) {
  echo "Your sign up failed. Please try again.";
}

if (!($addUser->bind_param("ssss", $fName, $lName, $username, $word))) {
  echo "Your sign up failed. Please try again.";
}

if (!($addUser->execute())) {
  echo "Your sign up failed. Please try again.";
} else {
  echo "Congratulations, you have signed up! Please sign in to begin posting!";
}

$addUser->close();


