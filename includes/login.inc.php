<?php
// An include file contains a PHP script that the user will never see 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate the LoginCont class
    include "../model/dbh.classes.php";
    include "../model/login.classes.php";
    include "../controller/login-contr.classes.php";
    $signup = new LoginContr($email, $password);

    // Running error handlers and user login
    $signup->loginUser();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
