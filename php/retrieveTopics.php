<?php

// this will retrieve the list of topics from the database

require("../cred.php");

$connect = new mysqli($host, $user, $pd, $db);
if ($connect->connect_errno) {
  echo 'Error retrieving topics1';
} // this connects to the database

if (!($countTopic = $connect->prepare("SELECT COUNT(*) FROM topics"))) {
  echo 'Error retrieving topics2';
}

if (!($countTopic->execute())) {
  echo "Error retrieving topics3";
}

if (!($countTopic->bind_result($number))) {
  echo "Error retrieving topics4";
}

$countTopic->fetch();

$countTopic->close();
// want to first figure out how many entries are in the database for the topics table


if ($number > 0) {
	// if there are entries, then they will output

	$connect = new mysqli($host, $user, $pd, $db);
	if ($connect->connect_errno) {
 	  echo 'Error retrieving topics1';
	} // this connects to the database

	if (!($retTopic = $connect->prepare("SELECT id, name, author FROM topics ORDER BY name ASC"))) {
	  echo 'Error retrieving topics5';
	}

	if (!($retTopic->execute())) {
	  echo 'Error retrieving topics6';
	}

    if (!($retTopic->bind_result($id, $topicN, $topicA))) {
      echo "Error retrieving results7";
    }

    while ($retTopic->fetch()) {
    	echo "<label for=\"$topicN\" class=\"message\"><input type=\"radio\" name=\"selection\" id=\"name\" value=\"$id\"> $topicN (by $topicA)</label><br><br>";
    }

    $retTopic->close();

} else {
	echo '<div class="message">There are currently no topics. You should start one!</div>';
	// if there are no current topics in the database, then this will output
}
