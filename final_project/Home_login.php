<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Delta Airlines - Home</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	//DEPARTURE DATES RESRTRICTED TO TODAY AND FUTURE
	var today = new Date();
	
	 $(function(){
	        $("#return_date").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0, maxDate: '2018-03-31', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" });
	        $("#depart_date").datepicker({ dateFormat: 'yy-mm-dd', minDate: 0, maxDate: '2018-03-31', showButtonPanel: true, changeMonth: true, changeYear: true, showAnim: "slideDown" }).bind("change",function(){
	            var minValue = $(this).val();
	            minValue = $.datepicker.parseDate("yy-mm-dd", minValue);
	            minValue.setDate(minValue.getDate());
	            $("#return_date").datepicker( "option", "minDate", minValue );
	        })
	    });

</script>

<?php
  session_start();
?>

</head>
<body>

<div id="background_contain">
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
        	Welcome, <?=$_SESSION['first_name']?>!&nbsp;&nbsp;&nbsp;&nbsp;
            <a id="login" type="button" href="logoutCheck.php">Log Out</a>
        </div>
        
        <div id="login_space">
        
        </div>
        
        <div class="quick_book">
        	<h3 id="booking_header">Book A Trip</h3>
        	<!-- BEGIN FORM -->
    		<form action="flightSearch_login.php" method="post">
	        	<div id="from_block">
	        	FROM: <br/><select id="origin_drop" onchange="updateSelect(this,'destination_drop')" name="origin" required>
	        			  <option value="" selected="selected"></option>
						  <option value="Phoenix, AZ (PHX)">Phoenix, AZ, US (PHX)</option>
						  <option value="Dallas, TX (DFW)">Dallas, TX, US (DFW)</option>
						  <option value="Atlanta, GA (ATL)">Atlanta, GA, US (ATL)</option>
						  <option value="Tokyo-Narita, Japan (NRT)">Tokyo-Narita, Japan, JP (NRT)</option>
						  <option value="Seoul, South Korea (ICN)">Seoul, South Korea, KR (ICN)</option>
						</select>
				</div>
				
				<div id="to_block">
	        	TO: <br/><select id="destination_drop" onchange="updateSelect(this,'origin_drop')" name="destination" required>
	        			  <option value="" selected="selected"></option>
						  <option value="Phoenix, AZ (PHX)">Phoenix, AZ, US (PHX)</option>
						  <option value="Dallas, TX (DFW)">Dallas, TX, US (DFW)</option>
						  <option value="Atlanta, GA (ATL)">Atlanta, GA, US (ATL)</option>
						  <option value="Tokyo-Narita, Japan (NRT)">Tokyo-Narita, Japan, JP (NRT)</option>
						  <option value="Seoul, South Korea (ICN)">Seoul, South Korea, KR (ICN)</option>
						</select>
				</div>
			
				<div id="depart_block">
	        	Depart Date:<br/> <input id="depart_date" name="depart" type="text" placeholder="yyyy-mm-dd" required>
	        	</div>
	        	
	        	<div id="return_block">
	        	Return Date:<br/> <input id="return_date" name="return" type="text" placeholder="yyyy-mm-dd" required> 	
	        	</div>
	        	
	        	<div id="passenger_block">
	        	Passengers:<br/> 
	        			<select id="passenger_drop" name="passengernumber" required>
	        			  <option value=""></option>
						  <option value=1>1</option>
						  <option value=2>2</option>
						  <option value=3>3</option>
						  <option value=4>4</option>
						  <option value=5>5</option>
						  <option value=6>6</option>
						</select>
	        	</div>
	        	
	        	<div id="trip_block">
	        	Type: <br/>
	        		<select id="trip_drop" name="trip_type" onchange="displayChange()" required>
	        			  <option value=""></option>
						  <option value="ROUND">Round Trip</option>
						  <option value="ONE">One Way</option>
						</select>
	        	</div>
    
        		<button id="search" onclick="getFlights()" type="submit">Find Flights</button>
        		</form>
        		<!-- END FORM -->
        
        </div>
        
        </div>
        
</div>

<script>

	// always update whether or not the return date is viewed
		var type = document.getElementById("trip_drop");
    	var returnDate = document.getElementById("return_block");
    	var returnElement = document.getElementById("return_date");
    	
    	if(type.value == "ROUND"){
    		returnDate.style.visibility = 'visible';
    		returnElement.required = true;
    	}
    	else if(type.value == "ONE"){
    		returnDate.style.visibility = 'hidden';
    		returnElement.required = false;
    	}
    	
    	
	

    function updateSelect(changedSelect, selectId) {
      var otherSelect = document.getElementById(selectId);
      for (var i = 0; i < otherSelect.options.length; ++i) {
        otherSelect.options[i].disabled = false;
      }
      if (changedSelect.selectedIndex == 0) {
        return;
      }
      otherSelect.options[changedSelect.selectedIndex].disabled = true;
    }
    // end restriction
    
   function displayChange(){
    	var type = document.getElementById("trip_drop");
    	var returnDate = document.getElementById("return_block");
    	var returnElement = document.getElementById("return_date");
    	
    	if(type.value == "ROUND"){
    		returnDate.style.visibility = 'visible';
    		returnElement.required = true;
    	}
    	else if(type.value == "ONE"){
    		returnDate.style.visibility = 'hidden';
    		returnElement.required = false;
    		returnElement.value = '';
    	}
    }
    
 </script>
       
             
 
</body>
</html>