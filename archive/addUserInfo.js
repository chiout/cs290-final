function submitInformation() {

	var age = escape(document.getElementById("age").value);
	var bio = escape(document.getElementById("bio").value);

	var sendInform = new XMLHttpRequest();
	var url = "php/addUserInfo.php?age="+age+"&bio="+bio;

	sendInform.onreadystatechange = whenReady;
	sendInform.open("GET", url, true);
	sendInform.send();

	function whenReady () {
		if (sendInform.readyState == 4) {
			if (sendInform.status == 200) {
				location.reload(); // reload the page after the info is sent to database
			}
		}
	}
	// this function will send the user's info to the database
	// this ajax call will work in the background

}