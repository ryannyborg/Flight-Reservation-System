<?php
// Name: Ryan Nyborg
// Date: April 28, 2017
// File: flightSearch.php

$origin = $_POST["origin"];
$destination = $_POST["destination"];
$depart = $_POST["depart"];
$return = $_POST["return"];
$passengers = $_POST["passengernumber"];
$type = $_POST["trip_type"];

?>

<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Delta Airlines - Home</title>
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
        	Signed on as <?=$_SESSION['first_name']?>.&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="login" type="button" href="logoutCheck.php">Log Out</a>
        </div>
        
        <div id="login_space">
        
        </div>
        
        <div class="search_result">
        
        	<div id="search_head">Select your flight from <?=$origin?> to <?=$destination?> on <?=$depart?></div>
        	
        	<div id="toChange"></div>
        	
        	<div id="selectedDiv">
        	
        	</div>
        	
        	<div id="nextButtonDiv">
        		<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>
        		<button onclick='advancePageReturn()' class='nextButton'>Next</button>
        	</div>
        
        </div>
        
        
        
</div>


<script>
//Use AJAX to change page
var divToChange = document.getElementById("toChange");
var changeSelected = document.getElementById("selectedDiv");
var depart_id = null; // flight id for 1st flight
var return_id = null; // flight id for 2nd flight
var totalPrice = 0.0; 
var finalPrice = 0.0; // total cost for reservationDB

var status = 0; // keeps track of page

var origin = "<?=$origin?>";
var destination = "<?=$destination?>";
var depart = "<?=$depart?>";
var return_flight = "<?=$return?>";
var passengers = <?=$passengers?>;

var anObj = new XMLHttpRequest();
		
if("<?=$type?>" == "ROUND"){
	nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
		+ "<button onclick='advancePageReturn()' class='nextButton'>Next</button>";

	anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
			+ "&depart=" + depart + "&passengers=" + passengers, true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
			// create a table of flights
			str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
			str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
				"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
				"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
				"</td><td>$" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
				"</td><td><button onclick='pickDepartFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
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

else if("<?=$type?>" == "ONE"){
	nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
	+ "<button onclick='toShoppingCart()' class='nextButton'>Next</button>";

	anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
			+ "&depart=" + depart + "&passengers=" + passengers, true);
	anObj.send();

	anObj.onreadystatechange = function() {
		
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);
			var str = "";
			// create a table of flights
			str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
			str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
			for (i = 0; i < array.length; i++){
				var temp = JSON.stringify(array[i]);
				str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
				"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
				"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
				"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
				"</td><td>$" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
				"</td><td><button onclick='pickDepartFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
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


function pickDepartFlight(num){
	var element = document.getElementById(num);
	var myArr = JSON.parse(element.value);
	var string = "You have selected: " + myArr.flight_number + " from " + myArr.origin + " to " + myArr.destination + " for $" +
	myArr.price + "<br/><br/>Click next to continue with your purchase.";
			changeSelected.innerHTML = string;

	depart_id = myArr.flight_id;
	
	}

function pickReturnFlight(num){
	var element = document.getElementById(num);
	var myArr = JSON.parse(element.value);
	var string = "You have selected: " + myArr.flight_number + " from " + myArr.origin + " to " + myArr.destination + " for $" +
	myArr.price + "<br/><br/>Click next to continue with your purchase.";
			changeSelected.innerHTML = string;

	return_id = myArr.flight_id;

	console.log(return_id);
	
	}

function advancePageReturn(){	

	console.log(status);

	if(depart_id == null){
		alert("Please select a flight.");
	}

	else{

		if(status == 0){
		status = parseFloat(status) + 1;
		}

		changeSelected.innerHTML = ""; // clear selected
		nextButtonDiv.innerHTML = "<button onclick='goBack()' id='backButton' class='nextButton'>Back</button>"
			+ "<button onclick='toShoppingCart()' class='nextButton'>Next</button>";
	
		if("<?=$type?>" == "ROUND"){
			// advance to select other flight
			anObj.open("GET", "searchController.php?origin=" + destination + "&destination=" + origin
					+ "&depart=" + return_flight + "&passengers=" + passengers, true);
			anObj.send();
	
			
	
			anObj.onreadystatechange = function() {
				
				if (anObj.readyState == 4 && anObj.status == 200) {
					var array = JSON.parse(anObj.responseText);
					var str = "";
					// create a table of flights
					str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
					str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
					for (i = 0; i < array.length; i++){
						var temp = JSON.stringify(array[i]);
						str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
						"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
						"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
						"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
						"</td><td>$" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
						"</td><td><button onclick='pickReturnFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
					}
					str += "</table>";
					search_head.innerHTML = "Select your flight from " + "<?=$destination?>" + " to " + "<?=$origin?>" + " on " + "<?=$return?>";
					if (array.length == 0){
						divToChange.innerHTML = "Sorry, no flights were found.";
					}
					else{
						divToChange.innerHTML = str;
					}
				}
			}
			
			
		}
	
		else if(<?=$type?> == "ONE"){
			// advance to shopping cart if logged in
			anObj.open("GET", "searchController.php?origin=" + destination + "&destination=" + origin
					+ "&depart=" + return_flight + "&passengers=" + passengers, true);
			anObj.send();
	
			
	
			anObj.onreadystatechange = function() {
				
				if (anObj.readyState == 4 && anObj.status == 200) {
					var array = JSON.parse(anObj.responseText);
					var str = "";
					// create a table of flights
					str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
					str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
					for (i = 0; i < array.length; i++){
						var temp = JSON.stringify(array[i]);
						str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
						"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
						"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
						"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
						"</td><td>$" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
						"</td><td><button onclick='toShoppingCart(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
					}
					str += "</table>";
					search_head.innerHTML = "Select your flight from " + "<?=$destination?>" + " to " + "<?=$origin?>" + " on " + "<?=$return?>";
					if (array.length == 0){
						divToChange.innerHTML = "Sorry, no flights were found.";
					}
					else{
						divToChange.innerHTML = str;
					}
				}
			}
			
		}
		
		// this function updates the page using AJAX
	}
}

function toShoppingCart(){
	if(return_id == null && ("<?=$type?>" == "ROUND")){
		alert("Please select a flight.");
	}

	else if(depart_id == null && ("<?=$type?>" == "ONE")){
		alert("Please select a flight.");
	}

	else{
		
		
		anObj.open("GET", "cartController.php?depart_id=" + depart_id + "&return_id=" + return_id, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
				var priceStr = "";
				var finalStr = "";
				// create a table of flights
				str = "<table><tr><th></th><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
				str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th></th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + (parseFloat(i)+1) + "</td><td>" + array[i]['flight_number'] + 
					"</td><td>" + array[i]['origin'] + "</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
					"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
					"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
					"</td><td>$" + array[i]['price'] + "</td></tr>";
					totalPrice = totalPrice + parseFloat(array[i]['price']);
				}
				search_head.innerHTML = "Please review your selected flights!";
				str += "</table>";
				totalPrice = totalPrice.toFixed(2);
				finalPrice = (totalPrice * <?=$passengers?>).toFixed(2);
				priceStr = totalPrice.toString();
				finalStr = finalPrice.toString();
				divToChange.innerHTML = str;
				changeSelected.innerHTML = "Total Cost: <b>$" + priceStr + " x <?=$passengers?> = $" + finalStr + "</b>";
				changeSelected.style.textAlign = "right";
				changeSelected.style.fontSize = "19px";
			}
		}
		nextButtonDiv.innerHTML = "<button onclick='location.href = \"home.html\";' id='backButton' class='nextButton'>Start Over</button>"
			+ "<button onclick='purchaseFlights()' class='nextButton'>Purchase</button>";
	}
}

function purchaseFlights(){

	if (confirm("Continue purchasing the flight(s) selected?") == true) {
// 		alert("Purchasing the flight...");

		
		// go to reserve the flight and CREATE reservation to user account


		anObj.open("GET", "reservationController.php?id=" + "<?=$_SESSION['id']?>" + "&totalCost=" + finalPrice + "&tripType=" + "<?=$type?>" 
				+ "&depart_id=" + depart_id + "&return_id=" + return_id + "&passengers=" + passengers, true);
		anObj.send();


		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				alert("Reservation created successfully. Thank you.");
				document.location.href='reservation_login.php';
			}
			else{
				
			}
		}


		
    } else {
        
    }
	
	
}

function goBack(){

	console.log(status);

	if(status == 0){
		window.location.assign("home.html");
	}
	else if(status == 1){
				
		anObj.open("GET", "searchController.php?origin=" + origin + "&destination=" + destination
				+ "&depart=" + depart + "&passengers=" + passengers, true);
		anObj.send();

		

		anObj.onreadystatechange = function() {
			
			if (anObj.readyState == 4 && anObj.status == 200) {
				var array = JSON.parse(anObj.responseText);
				var str = "";
				// create a table of flights
				str = "<table><tr><th>Flight Number</th><th>From</th><th>To</th><th>Departure Date</th><th>Departure Time</th>";
				str += "<th>Arrival Date</th><th>Arrival Time</th><th>Flight Length</th><th>Price</th><th>Seats Left</th><th></th>";
				for (i = 0; i < array.length; i++){
					var temp = JSON.stringify(array[i]);
					str += "<tr><td>" + array[i]['flight_number'] + "</td><td>" + array[i]['origin'] + 
					"</td><td>" + array[i]['destination'] + "</td><td>" + array[i]['depart_day'] + 
					"</td><td>" + array[i]['depart'] + "</td><td>" + array[i]['arrival_day'] + 
					"</td><td>" + array[i]['arrival'] + "</td><td>" + array[i]['length'] + 
					"</td><td>$" + array[i]['price'] + "</td><td>" + array[i]['seats_available'] + 
					"</td><td><button onclick='pickFlight(" + i + ")' value='" + temp + "' class='nextButton' id='" + i + "'>Select</button></td></tr>";
				}
				str += "</table>";
				search_head.innerHTML = "Select your flight from " + "<?=$origin?>" + " to " + "<?=$destination?>" + " on " + "<?=$depart?>";
				if (array.length == 0){
					divToChange.innerHTML = "Sorry, no flights were found.";
				}
				else{
					divToChange.innerHTML = str;
				}
			}
		}
	}

	if(status == 1){
		status--;
	}
	
}

</script>



</body>
</html>

