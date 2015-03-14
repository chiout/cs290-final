<?php

// this code will retrieve all existing messages for a topic
require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error retrieving messages';
} // this connects to the database

if (!($countMess = $connect->prepare("SELECT COUNT(*) FROM messages WHERE topic=(?)"))) {
  echo 'Error retrieving messages2';
}

if (!($countMess->bind_param("i", $id))) {
  echo 'Error retrieving messages';
}

if (!($countMess->execute())) {
  echo "Error retrieving messages3";
}

if (!($countMess->bind_result($number))) {
  echo "Error retrieving messages4";
}

$countMess->fetch();

$countMess->close();

// want to first figure out how many entries are in the database for the topics table


if ($number > 0) {
	// if there are entries, then they will output

	$connect = new mysqli($host, $user, $pd, $db);
	if ($connect->connect_errno) {
 	  echo 'Error retrieving messages1';
	} // this connects to the database

	if (!($retMess = $connect->prepare("SELECT author, message, dates FROM messages WHERE topic=(?) ORDER BY dates ASC"))) {
	  echo 'Error retrieving messages5';
	} // retrieve the proper messages in order of ascending dates

	if (!($retMess->bind_param("i", $id))) {
      echo 'Error retrieving messages';
    }

	if (!($retMess->execute())) {
	  echo 'Error retrieving messages6';
	}

    if (!($retMess->bind_result($mAuthor, $printMess, $mDate))) {
      echo "Error retrieving messages7";
    }

    while ($retMess->fetch()) {

      if (file_exists("../img/$mAuthor")){
        echo "<div class=\"writerBlock\"><img style=\"height:50px; width:50px; margin-bottom:10px; margin-right:5px; float:left; margin-left:20px;\" src=\"../img/$mAuthor/$mAuthor.png\">";
        echo "<div class=\"bName\"><a href=\"user.php?user=$mAuthor\">$mAuthor</a></div><div class=\"bDate\">$mDate</div></span>";
        echo "<div class=\"messageBlock\">$printMess</div></div>";
        // so print out the icon if the person has a profile icon
      } else {
        echo "<div class=\"writerBlock\"><img style=\"height:50px; width:50px; margin-bottom:10px; margin-right:5px; float:left; margin-left:20px;\" src=\"../img/default.png\">";
        echo "<div class=\"bName\"><a href=\"user.php?user=$mAuthor\">$mAuthor</a></div><div class=\"bDate\">$mDate</div></span>";
        echo "<div class=\"messageBlock\">$printMess</div></div>";
      } // if the user has not uploaded a profile picture, then they will automatically use the default picture
    } // this prints out the message

    $retMess->close();

} else {
	echo '<div class="writerBlock"><div class="bName">There are currently no messages. You should start the conversation!</div></div>';
	// if there are no current topics in the database, then this will output
}
