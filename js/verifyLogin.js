function checkLogin () {
	var userName = escape(document.getElementById("username").value);
	var secret = escape(document.getElementById("password").value);


	var checkLogin = new XMLHttpRequest();
	var url = "php/checkLogin.php"; // send it via a get request
	var info = "user=" + userName + "&value=" + secret;
	checkLogin.open('POST', url, true);
  checkLogin.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  checkLogin.onreadystatechange = whenitsReady;
  checkLogin.send(info);	

  /* based on code in lines 6-28 of http://www.developphp.com/video/JavaScript/Ajax-Post-to-PHP-File-XMLHttpRequest-Object-Return-Data-Tutorial
  */

/*
	var checkLogin = new XMLHttpRequest();
	var url = "php/checkLogin.php?user=" + userName + "&value=" + secret; // send it via a get request
	checkLogin.onreadystatechange = whenitsReady;
	checkLogin.open('GET', url, true);
  checkLogin.send();	
  */ // changed the AJAX call to POST to be more secure

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