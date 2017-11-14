<?php 
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
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

<div class="contactus">
<div id="phone_contact">If you need help with a flight reservation, please call us at <b>1-800-221-1212</b>.<br/></div>
<div style="border:0; padding-bottom:10px;">Corporate Headquarters:</div>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d330500.9230069805!2d-84.50537525037508!3d33.70944210018431!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x88f4fd4485474603%3A0x9848cdea701fe8a4!2s1030+Delta+Blvd%2C+Atlanta%2C+GA+30354!5e0!3m2!1sen!2sus!4v1493742881324"
		width="400" height="300" style="border:0;"></iframe>
		 
		</div>
		</div>
		 
		 

		</body>
		</html>