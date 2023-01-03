<?php
// Gets the data from the signup form
// Instantiates the accountController class
// If no errors, redirect user to index page 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];
    $enabled = true;


    // Instantiate the SignupContr class
    include "../framework/dbh.classes.php";
    include "../dao/accountDAO.php";
    include "../controller/accountController.php";
    $signup = new accountController($username, $email, $password, $passwordrepeat, $enabled);

    // Running error handlers and user signup
    $signup->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../view/signup.php?error=none");
}
