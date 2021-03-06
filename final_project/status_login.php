<?php 
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Flight Status</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
//DEPARTURE DATES RESRTRICTED TO TODAY AND FUTURE
var today = new Date();

$(function(){
	$("#depart_date").datepicker({ dateFormat: 'yy-mm-dd', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" });
});

	</script>

	</head>
	<body>

	<div id="menubar-id">

	<div class="menubar-class">

	<a href="Home_login.php"><img id="menu_logo" src="images/delta_logo.jpg" alt="Delta"/></a>

	<ul>
	<li><a href="Home_login.php">Home</a></li>
                <li><a href="status_login.php">Flight Status</a></li>
                <li><a href="reservation_login.php">Reservations</a></li>
                <li><a href="contact_login.php">Contact Us</a></li>
	</ul>

	</div>

	<div id="menubar_space">

	</div>

	<div class="login">
        	Signed in as <?=$_SESSION['first_name']?>.&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="login" type="button" href="logoutCheck.php">Log Out</a>
        </div>

	<div class="search_result">
	<h3 id="booking_header">Find Flight Status</h3>
	 
	<div id="toChange">
	 
	Flight Number<br> <input type="text" id="flight_number" name="number" placeholder="DL ####" required>
	<br><br>
	Date <br> <input type="text" id="depart_date" name="depart"  placeholder="yyyy-mm-dd" required>
	<br>&nbsp;<br>
	<button onclick="findFlights()" id="search">Search</button>
	 
	</div>
	 
	</div>

	</div>


	<script>
	function findFlights(){
		//Use AJAX to change page
		var divToChange = document.getElementById("toChange");
		var num = document.getElementById("flight_number");
		var day = document.getElementById("depart_date");

		var anObj = new XMLHttpRequest();

		anObj.open("GET", "statusSearch.php?number=" + num.value + "&depart=" + day.value, true);
		anObj.send();

		anObj.onreadystatechange = function() {

			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
				// create a table of flights
				str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
				str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] +
					"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] +
					"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] +
					"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] +
					"</td></tr>";
				}
				str += "</table>";
				if (array.length == 0){
					divToChange.innerHTML = "Sorry, no flights were found.";
				}
				else{
					divToChange.innerHTML = str;
				}
			}
		}
	}
	</script>
	 
	 

	</body>
	</html>