<?php

// ...

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the data
    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];

    // Instantiate the forgotPasswordController class
    include "../framework/databaseHandler.php";
    include "../controller/resetPasswordController.php";
    $reset = new resetPasswordController($selector, $validator, $password, $passwordrepeat);

    // Running server side validation, error handling and reset the password
    $reset->run();
} else {
    header("location: ../index.php");
}
