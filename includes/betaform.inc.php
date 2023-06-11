<?php

// Define the namespace of this class
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this script depends on
use Controller\betaFormController;

// An include file that runs a PHP script
// Gets the data from the betaform trough the $_POST method
// Uses this data to instantiate a betaFormController object
// The betaFormController will run several server side validations
// If no errors return user to the index.php with a success message

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");


    // Instantiate the betaFormController class
    include "../framework/databaseHandler.php";
    include "../dao/accountDAO.php";
    include "../controller/betaFormController.php";
    $beta = new betaFormController($name, $email);

    // Running server side validation and error handling
    $beta->run();

    // Redirect user back to the front page when successfull with a success message
    header("location: ../index.php?beta=success#tester-section");
    exit();
}
