<?php
// Programmer: SangHyun Park
session_start (); 
class DatabaseAdaptor {
    private $DB;

    public function __construct() {
        $db = 'mysql:dbname=flight_reservation;host=127.0.0.1;charset=utf8';
        $user = 'root';
        $password = '';

        try {
            $this->DB = new PDO ( $db, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }

    // Use prepared statements and bindParam to avoid concatenating strings
    // searching database for create new user id
    public function checkId($id){
        $sqlCheck = $this->DB->prepare("SELECT * FROM account_info WHERE id = :id");
        $sqlCheck->bindParam('id', $id);
        $sqlCheck->execute();
        if($sqlCheck->fetchColumn() >= 1){
            echo 'This ID already created';
            exit;
        }
    }
    
    // create user information
   public function create_user_account($id, $pwd, $first_name, $middle_name, $last_name, $gender, $birthDay, $country, $address, $city, $state, $postCode, $phoneNumber, $email){
        $sql = "INSERT into account_info(id, pwd, first_name, middle_name, last_name, gender, birthDay, country, address, city, state, postCode, phoneNumber, email)";
        $sql = $sql."values('$id', '$pwd', '$first_name', '$middle_name', '$last_name', '$gender', '$birthDay', '$country', '$address', '$city', '$state', '$postCode', '$phoneNumber', '$email')";
        if($this->DB->query($sql)){
            echo "<script>alert(\"Thank you for sign up. You can use your new ID and Password.\");</script>";
            echo "<script> document.location.href='logIn.php';</script>";
            exit;
        }else{
            echo "<script>alert(\"Sorry, you are fail to create new account. Please try again later.\");</script>";
            echo "<script> document.location.href='logIn.php';</script>";
            exit;
        }
    }

    // Use prepared statements and bindParam to avoid concatenating strings
    // Uses salted hashed passwords in the data base
    // Password check for login
    public function check_login($id, $pwd){
        $sqlCheck = $this->DB->prepare("SELECT * FROM account_info WHERE id = :id");
        $sqlCheck->bindParam('id', $id);
        $sqlCheck->execute();

        $row = $sqlCheck->fetch(PDO::FETCH_ASSOC);

        if (password_verify($pwd, $row['pwd'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['middle_name'] = $row['middle_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['birthDay'] = $row['birthDay'];
            $_SESSION['country'] = $row['country'];
            $_SESSION['address'] = $row['address'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['state'] = $row['state'];
            $_SESSION['postCode'] = $row['postCode'];
            $_SESSION['phoneNumber'] = $row['phoneNumber'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['flight'] = $row['flight'];
            echo 'Hellow, '.$_SESSION['id'];
            echo "<script>alert(\"Welcome to Delta Air Lines\");</script>";
            header('Location:Home_login.php');
        } else {
            echo "<script>alert(\"Sorry, your ID or Password did not matched. Please check your ID and Password.\");</script>";
            echo "<script> document.location.href='logIn.php';</script>";
            exit;
        }
    }


} // End class DatabaseAdaptor

// Testing code that should not be run when a part of MVC
$theDBA = new DatabaseAdaptor ();

?>