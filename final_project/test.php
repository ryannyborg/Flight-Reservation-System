<?php
    // this is only for test
    // do not turn in this file
    session_start();
 
    if($_SESSION['id'] != null){
        echo "this is test section in!!! : ";
        echo 'id, '.$_SESSION['id'] .' ,';
        echo 'first_name, '.$_SESSION['first_name'] .' ,';
        echo 'middle_name, '.$_SESSION['middle_name'] .' ,';
        echo 'last_name, '.$_SESSION['last_name'] .' ,';
        echo 'gender, '.$_SESSION['gender'] .' ,';
        echo 'birthDay, '.$_SESSION['birthDay'] .' ,';
        echo 'country, '.$_SESSION['country'] .' ,';
        echo 'address, '.$_SESSION['address'] .' ,';
        echo 'city, '.$_SESSION['city'] .' ,';
        echo 'state, '.$_SESSION['state'] .' ,';
        echo 'postCode, '.$_SESSION['postCode'] .' ,';
        echo 'phoneNumber, '.$_SESSION['phoneNumber'] .' ,';
        echo 'email, '.$_SESSION['email'] .' ,';
        echo 'flight, '.$_SESSION['flight'] .' ,';
    }
 
    if($_SESSION['id'] == null){
        
        echo "this is test section out";
    }
?>