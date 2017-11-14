<?php
    include 'model.php';
    
    session_start();

    $id = $_POST['id'];
    $pwd = $_POST['pwd'];
 
 
    $res = $theDBA->check_login($id, $pwd);

?>