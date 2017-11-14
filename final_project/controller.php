<?php
// Programmer: SangHyun Park 

include 'model.php';  // for $theDBA, an instance of DataBaseAdaptor
$id = $_POST['id'];
$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);  // Uses salted hashed passwords in the data base
$pwdCheck = $_POST["pwdCheck"];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$gender = $_POST['gender'];
$birthDay = $_POST['birthDay'];
$country = $_POST['country'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$postCode = $_POST['postCode'];
$phoneNumber = $_POST['phoneNumber'];
$email = $_POST['email'];
$emailCheck = $_POST['emailCheck'];

if (!password_verify($pwdCheck, $pwd) ){ 
    echo "<script>alert(\"The password do not matched.\");</script>";
    echo "<script> document.location.href='signUp.php';</script>";
    exit;
} else if ($email != $emailCheck){
    echo "<script>alert(\"The Email Address do not matched.\");</script>";
    echo "<script> document.location.href='signUp.php';</script>";
    exit;
}

$res = $theDBA->checkId($id);

$theDBA->create_user_account($id, $pwd, $first_name, $middle_name, $last_name, $gender, $birthDay, $country, $address, $city, $state, $postCode, $phoneNumber, $email);

?>