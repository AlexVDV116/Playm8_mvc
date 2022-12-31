<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the LoginController class
// After instantiating the LoginController class it uses the loginUser method and redirect the user to the index page 

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

    // Running error handlers and user login
    $login->run();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
