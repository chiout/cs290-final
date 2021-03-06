<?php

// this will retrieve user information from the database
// same concept as getUserData.php except this will retrieve data for other users

require("../cred.php");

if (isset($_GET['user'])) {

	$otherUser = $_GET['user'];

	$connect = new mysqli($host, $user, $pd, $db);
	if ($connect->connect_errno) {
		  echo 'Error retrieving user info';
	} // this connects to the database

	if (!($retUser = $connect->prepare("SELECT first, last, age, bio FROM credentials WHERE user=(?)"))) {
	  echo 'Error retrieving user info';
	}

	if (!($retUser->bind_param('s', $otherUser))) {
	  echo 'Error retrieving user info';
	}

	if (!($retUser->execute())) {
	  echo 'Error retrieving user info';
	}

	if (!($retUser->bind_result($fName, $lName, $age, $bio))) {
	  echo "Error retrieving user info";
	}

	$retUser->fetch();

	$retUser->close();

	if ($age == null) {
		$age = "N/A";
	}

	if ($bio == null) {
		$bio = "N/A";
	}

	echo "<h2>$otherUser</h2>
			<br>
			<span id=\"pName\">Name:</span> 
			<span id=\"pInfo\">$fName $lName</span>
			<br><br>
			<span id=\"pName\">Age:</span> 
			<span id=\"pInfo\">$age</span>
			<br><br>
			<span id=\"pName\">Biography:</span> 
			<span id=\"pInfo\">$bio</span>";
	// retrieve data is GET variable has a value
	// otherwise we will let the user know it is an empty search!

	if (file_exists("../img/$otherUser")){
        echo "<br><br><span id=\"pName\">Profile Pic/Icon: </span><img style=\"height:50px; width:50px;\" src=\"../img/$otherUser/$otherUser.png\">";
        // so print out the icon if the person has a profile icon
      } else {
        echo "<br><br><span id=\"pName\">Profile Pic/Icon: </span><img style=\"height:50px; width:50px;\" src=\"../img/default.png\">";
      } // if the user has not uploaded a profile picture, the default profile icon will display
} else {
	echo "<h3>This is an empty search!</h3>";
}

/*
all prepared statements used in the php files in this website are based on prepared statements format found here:
http://php.net/manual/en/mysqli.quickstart.prepared-statements.php (primarily examples 1, 2, 6)
*/

