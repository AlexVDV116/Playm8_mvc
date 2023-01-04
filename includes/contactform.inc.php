<?php

// An include file that runs a PHP script
// Gets the data from the contactform trough the $_POST method
// Uses this data to instantiate a contactFormController object
// The contactFormController will run several server side validations
// If no errors return user to the contact.php with a success message

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $name = $_POST["name"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $need = $_POST["need"];
    $message = $_POST["message"];

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
    session_unset();
    session_destroy();
}
