<?php

// An include file that runs a PHP script
// Gets the data from the betaform trough the $_POST method
// Uses this data to instantiate a betaFormController object
// The betaFormController will run several server side validations
// If no errors return user to the index.php with a success message

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST["submit"])) {

    // Grabbing the data
    $name = $_POST["name"];
    $email = $_POST["email"];


    // Instantiate the betaFormController class
    include "../framework/databaseHandler.php";
    include "../dao/accountDAO.php";
    include "../controller/betaFormController.php";
    $beta = new betaFormController($name, $email);

    // Running server side validation and error handling
    $beta->run();

    // Redirect user back to the front page when successfull with a success message
    header("location: ../index.php?beta=success#tester-section");
}
