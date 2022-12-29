<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the formContr class
// After instantiating the formContr class it uses the betaUserChecks method and redirects the user to the index page 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST["submit"])) {

    // Grabbing the data
    $naam = $_POST["naam"];
    $email = $_POST["email"];


    // Instantiate the FormContr class
    include "../framework/dbh.classes.php";
    include "../dao/form.classes.php";
    include "../controller/form-contr.classes.php";
    $beta = new formContr($naam, $email);

    // Running error handlers and user login
    $beta->betaUserChecks();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
