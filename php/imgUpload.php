<?php

if (file_exists("../img/$username")){
	echo "<p class=\"message\">Your Uploaded Icon:</p>
	<img style=\"height:50px; width:50px; margin-bottom:10px;\" src=\"../img/$username/$username.png\">";
} // if the path exists, then show the image
// the path is only created if an image is uploaded so the image must exist if the path exists

if (isset($_FILES['profPic']['name'])) {

	if($_FILES['profPic']['error'] > 0) {
		die ("Upload Error");
	}

	if($_FILES['profPic']['type'] != 'image/png') {
		die("File type not supported");
	}

	if($_FILES['profPic']['size'] > 160000) {
		die("File size larger than 160kb");
	} // make sure the image stays small
	/* the three if statements above are based on lines 1-3 for the error, type, and size file checking sections found at http://codular.com/php-file-uploads
	*/
	
	if(!file_exists("../img/$username")) {
		mkdir("../img/$username", 0777, true);
	} // makes a folder for each user if it does not yet exist

	$temp = explode(".",$_FILES['profPic']['name']);
	$name = $username.".".end($temp); // renames file to be the username
	/* based this code of Ben Fortune's response, lines 1-3
	http://stackoverflow.com/questions/18705639/how-to-rename-uploaded-file-before-saving-it-into-a-directory
	*/

	if(!move_uploaded_file($_FILES['profPic']['tmp_name'], "../img/$username/".$name)) {
		die("Error moving file");
	}
	// move the file to its new directory
	/*this code is based on lines 1-4 for the file upload section found at http://codular.com/php-file-uploads*/



}
