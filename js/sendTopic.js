function send() {

	var topicName = escape(document.getElementById("startField").value);

	var sendTopic = new XMLHttpRequest();
	var url = "php/sendTopic.php?name=" + topicName + "&user=" + user;

	sendTopic.onreadystatechange = whenReady;
	sendTopic.open("GET", url, true);
	sendTopic.send();

	function whenReady () {
		if (sendTopic.readyState == 4) {
			if (sendTopic.status == 200) {
				//window.location="messageTemplate.php";
				console.log("ready");
			}
		}
	}
	// this function will send the topic name and username to the database through the sendTopic.php file
	// this ajax call will work in the background

}

/* found info on this on http://www.w3schools.com/ajax/ajax_xmlhttprequest_send.asp
Lines 1-2 for all 3 GET examples */