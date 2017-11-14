<!DOCTYPE html>
<!-- 
Programmer: SangHyun Park 
-->
<html>
<head>
<meta charset="UTF-8">
<title>Delta Airlines - Sign Up</title>
<link href="styles_one.css" type="text/css" rel="stylesheet" />
</head>
<body>

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
    <a id="login" type="button" href="logIn.php">Log In</a>
  </div>

  <div class="personal">
    <h3 id="information_header">Personal Information</h3>

    <form name="join" method="post" action="controller.php">

    <h5 id="information_sub1">Login Info</h5>

    <div id="user_name">
    *USERNAME: <br/><input type="text" size="30" name="id" required>
    </div>

    <div id="password">
    *PASSWORD: <br/><input type="password" size="30" name="pwd" required>
    </div>

    <div id="password">
    *CONFIRM PASSWORD: <br/><input type="password" size="30" name="pwdCheck" required>
    </div>

    <h5 id="information_sub1">Basic Info</h5>

    <div id="first_name">
    *FIRST NAME: <br/><input type="text" size="30" maxlength="10" name="first_name" required>
    </div>

    <div id="middle_name">
    MIDDLE NAME: <br/><input type="text" size="30" maxlength="10" name="middle_name">
    </div>

    <div id="last_name">
    *LAST NAME: <br/><input type="text" size="30" maxlength="10" name="last_name" required>
    </div>

    <div class="box"></div>

    <div id="gender">
    *GENDER: <br/><select id="gender_drop" name="gender">
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  </select>
    </div>

    <div id="birth_day">
    *Date of Birth:<br/><input id="birth_date" type="date" name="birthDay" required>
    </div>



    <h5 id="information_sub2">Contact Info</h5>

    <div id="country">
    *COUNTRY: <br/><select id="country_drop" name="country">
                  <option value="usa">United States</option>
                  <option value="korea">South Korea</option>
                  <option value="japan">Japan</option>
                  </select>
    </div>

    <div id="address">
    *ADDRESS LINE: <br/><input type="text" size="40" name="address" required>
    </div>

    <div class="box"></div>



    <div id="city">
    *CITY: <br/><input type="text" size="40" name="city" required>
    </div>

    <div id="state">
    *STATE/PROVINCE: <br/><input type="text" size="40" name="state" required>
    </div>

    <div class="box"></div>

    <div id="postCode">
    *POSTAL CODE: <br/><input type="text" size="40" name="postCode" required>
    </div>

    <div id="phoneNumber">
    *PHONE NUMBER: <br/><input type="text" size="40" name="phoneNumber" required>
    </div>

    <div class="box"></div>

    <div id="email">
    *EMAIL: <br/><input type="text" size="40" name="email" required>
    </div>

    <div id="email">
    *CONFIRM EMAIL ADDRESS: <br/><input type="text" size="40" name="emailCheck" required>
    </div>

    <div class="box"></div>

    <button id="complete" type="submit">COMPLETE</button>
    <button id="reset" type="reset">RESET</button>


    </form>

  </div>
  
  <div id="login_space"> &nbsp;</div>
        
</div>

</body>
</html>