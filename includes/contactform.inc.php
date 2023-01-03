<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the formContr class
// After instantiating the formContr class it uses the betaUserChecks method and redirects the user to the index page 
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



    // Instantiate the FormContr class
    include "../framework/databaseHandler.php";
    include "../controller/contactFormController.php";
    $contact = new contactFormController($name, $lastname, $email, $need, $message);

    // Running error handlers 
    $contact->run();

    header("Location: ../view/contact.php?contact=success");
}
