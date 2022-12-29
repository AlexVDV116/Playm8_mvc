<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the LoginController class
// After instantiating the LoginController class it uses the loginUser method and redirect the user to the index page 

if (isset($_POST["submit"])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Instantiate the LoginCont class
    include "../framework/dbh.classes.php";
    include "../dao/login.classes.php";
    include "../controller/login-contr.classes.php";
    $signup = new LoginContr($email, $password);

    // Running error handlers and user login
    $signup->loginUser();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
