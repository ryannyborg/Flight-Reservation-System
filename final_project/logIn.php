<!DOCTYPE html>
<!-- 
Programmer: SangHyun Park 
-->
<html>
<head>
<meta charset="UTF-8">
<title>Delta Airlines - Login</title>
<link href="styles.css" type="text/css" rel="stylesheet" />
</head>
<body>

<div id="background_contain">
<div id="menubar-id">

    <div class="menubar-class">
        
        <a href="home.html"><img id="menu_logo" src="images/delta_logo.jpg" alt="Delta"/></a>
            
        <ul>
            <li><a href="home.html">Home</a></li>
            <li><a href="status.html">Flight Status</a></li>
            <li><a href="reservation.html">Reservations</a></li>
            <li><a href="contact.html">Contact Us</a></li>
        </ul>
        
    </div>

    <div id="menubar_space"></div>

    <div class="login">
        <a id="signup" href="signUp.php">Sign Up</a>
    </div>

    <div id="login_space"></div>

    <div class="quick_book">
        <h3 id="information_header">Log In To My Delta</h3>

  

        <form name="join" method="post" action="loginCheck.php">

        <div class="box"></div>

        <div id="loginbg">
        USERNAME: <br/><input type="text" placeholder="Enter Username" name="id" required>
        </div>
        <div class="box"></div>


        <div id="loginbg">
        PASSWORD: <br/><input type="password" placeholder="Enter Password" name="pwd" required>
        </div>



        <br/>

        <button id="loginpg" type="submit">Login</button><br>
        <button id="cancel" type="reset">Cancel</button>


        </form>

    </div>
</div>
</div>

</body>
</html>

