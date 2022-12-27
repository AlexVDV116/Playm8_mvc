<?php
// .inc refers to that this is an include file - naming convention
// this means that the user does not see the file it just has a basic php script that runs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate the LoginCont class
    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $signup = new LoginContr($email, $password);

    // Running error handlers and user login
    $signup->loginUser();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
