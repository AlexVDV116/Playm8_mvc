<?php

// An include file that runs a PHP script
// Gets the data from the loginform trough the $_POST method
// Uses this data to instantiate a loginController object
// The loginController will run several server side validations
// If no errors return user to the index.php with a success message


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate the LoginCont class
    include "../framework/databaseHandler.php";
    include "../dao/loginDAO.php";
    include "../controller/loginController.php";
    $login = new LoginController($email, $password);

    // Running server side validation, error handling and login user
    $login->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
