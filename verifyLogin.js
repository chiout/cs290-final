function checkLogin () {
	var userName = escape(document.getElementById("username").value);
	var secret = escape(document.getElementById("password").value);

/*
	var checkLogin = new XMLHttpRequest();
	var url = "checkLogin.php"; // send it via a get request
	var info = "user=" + userName + "&value=" + secret;
	checkLogin.open('POST', url, true);
  checkLogin.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  checkLogin.onreadystatechange = whenReady;
  checkLogin.send(info);	
*/

	var checkLogin = new XMLHttpRequest();
	var url = "checkLogin.php?user=" + userName + "&value=" + secret; // send it via a get request
	checkLogin.onreadystatechange = whenitsReady;
	checkLogin.open('GET', url, true);
  checkLogin.send();	

	function whenitsReady () {
		if (checkLogin.readyState == 4) {
			if (checkLogin.status == 200) {
				if(checkLogin.responseText=="invalid") {
					document.getElementById("errorMessage").className = "block";
				}
				else if (checkLogin.responseText=="valid") {
					window.location='dashboard.php';
				}
			}
		}
	}
}