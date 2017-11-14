<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Reservations</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
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
		
		<div id="login_space">
		
		</div>
		
		<div class="search_result">
			<h3 id="booking_header">Your Reservations</h3>
        	
        	<div id="toChange"></div>
        	
        	<div id="nextButtonDiv"></div>
        	
		</div>
	
	</div>
 
 <script>
//Use AJAX to change page
 var divToChange = document.getElementById("toChange");
 var buttonToAdd = document.getElementById("nextButtonDiv");
 var id = 0;

 var anObj = new XMLHttpRequest();

	anObj.open("GET", "searchReservationController.php?id=" + "<?=$_SESSION['id']?>", true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
			// create a table of flights
			str = "<table><tr><th>Reservation ID</th><th>From</th><th>To</th><th>Total Cost</th><th>Passengers</th>";
			str += "<th>Trip Type</th><th></th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				var res_id = array[i]['memberSeq'];
				str += "<tr><td>" + array[i]['memberSeq'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>$" + array[i]['totalCost'] + 
				"</td><td>" + array[i]['passengers'] + "</td><td>" + array[i]['tripType'] +
				"</td><td><button onclick='getDetails(" + res_id + ")' value='' class='nextButton' id='" + i + "'>Details</button></td>"
				+ "</td><td><button onclick='deleteReservation(" + res_id + ")' value='' class='nextButton' id='" + i + "'>Cancel</button></td></tr>";
			}
			str += "</table>";
			if (array.length == 0){
				divToChange.innerHTML = "You have not made a reservation yet!";
			}
			else{
				divToChange.innerHTML = str;
			}
		}
	}


	
	function getDetails(id){
		
		anObj.open("GET", "flightDetail.php?id=" + id, true);
		anObj.send();

		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
				// create a table of flights
				str = "<table><tr><th>Flight #</th><th>From</th><th>Depart Date</th><th>Depart Time</th><th>To</th><th>Arrival Date</th><th>Arrival Time</th><th>Length</th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
					"</td><td>" + array[i]['depart_day'] + "</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['destination'] + 
					"</td><td>" + array[i]['arrival_day'] + "</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + "</td></tr>";
				}
				str += "</table>";
				buttonToAdd.innerHTML = "<a class='nextButton' type='button' href=\"reservation_login.php\">Close</a>"
				if (array.length == 0){
					divToChange.innerHTML = "Error showing detail!";
				}
				else{
					divToChange.innerHTML = str;
				}
			}
		}
	}


	
	function deleteReservation(id){
		if (confirm("There is a $200.00 change fee for canceling your flight.\n\nAre you sure you want to remove this reservation?") == true) {
			// delete from database

		anObj.open("GET", "deleteReservationController.php?id=" + id, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				alert("Reservation deleted successfully.");
				document.location.href='reservation_login.php';
			}
			else{
				
			}
		}


			
		}
		else{
			
		}
	}

	/* SELECT reservation.memberSeq, flights.origin, flights.destination, reservation.totalCost, reservation.passengers, 
	reservation.tripType FROM reservation JOIN flights ON reservation.depart_id = flights.flight_id WHERE reservation.id = "rnyborg";*/



 </script>
 

</body>
</html>