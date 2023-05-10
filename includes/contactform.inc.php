<?php

// Define the namespace of this script
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this script depends on
use Controller\contactFormController;

// An include file that runs a PHP script
// Gets the data from the contactform trough the $_POST method
// Uses this data to instantiate a contactFormController object
// The contactFormController will run several server side validations
// If no errors return user to the contact.php with a success message

session_start();

if (isset($_POST["submit"])) {

    // Grabbing the data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
    $lastname = htmlspecialchars($_POST["lastname"], ENT_QUOTES, "UTF-8");
    $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
    $need = htmlspecialchars($_POST["need"], ENT_QUOTES, "UTF-8");
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");

    // Assign all posted values to a session variable array
    if (!empty($_POST)) {
        foreach ($_POST as $key => $value) {
            $_SESSION['contact_form'][$key] = $value;
        }
    }

    // Instantiate the contactFormController class
    include "../framework/databaseHandler.php";
    include "../controller/contactFormController.php";
    $contact = new contactFormController($name, $lastname, $email, $need, $message);

    // Running server side validation and error handling
    $contact->run();

    // Redirect user back to the contact page when successfull with a success message
    header("Location: ../view/contact.php?error=none");
}
