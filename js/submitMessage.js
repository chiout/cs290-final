function submitMessage() {

	var topicBlurb = escape(document.getElementById("nMessage").value);

	var sendMessage = new XMLHttpRequest();
	var url = "php/submitMessage.php?auth="+author+"&top="+topicId+"&mess=" + topicBlurb;

	sendMessage.onreadystatechange = whenReady;
	sendMessage.open("GET", url, true);
	sendMessage.send();

	function whenReady () {
		if (sendMessage.readyState == 4) {
			if (sendMessage.status == 200) {
				location.reload(); // reload the page after the info is sent to database
			}
		}
	}
	// this function will send the message text to the database through the submitMessage.php file
	// this ajax call will work in the background

}

/* found info on this on http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
Lines 1-2 for all 3 GET examples */