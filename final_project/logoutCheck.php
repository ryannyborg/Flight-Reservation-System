<?php
    session_start();
 
    unset($_SESSION['user']);
 
    if($_SESSION['user'] == null){
        echo "<script>alert(\"log out complete.\");</script>";
        header('Location:home.html');
    }
?>