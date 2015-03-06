function send() {

	var topicName = escape(document.getElementById("startField").value);

	var sendTopic = new XMLHttpRequest();
	var url = "sendTopic.php?name=" + topicName + "&user=" + user;

	sendTopic.onreadystatechange = whenReady;
	sendTopic.open("GET", url, true);
	sendTopic.send();

	function whenReady () {
		if (sendTopic.readyState == 4) {
			if (sendTopic.status == 200) {
				window.location="messageTemplate.php";
			}
		}
	}

}