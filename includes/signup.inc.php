<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the SignupCont class
// After instantiating the SignupContr class it uses the signupUser method and redirect the user to the index page if no errors occur

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
    header("location: ../index.php?error=none");
}
