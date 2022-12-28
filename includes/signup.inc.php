<?php
// An include file which contains the PHP script that the gets the data from the form and uses it to instantiate the SignupCont class
// After instantiating the SignupContr class it uses the signupUser method and redirect the user to the index page if no errors occur

if (isset($_POST["submit"])) {

    // Grabbing the data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];
    $enabled = true;

    // Instantiate the SignupContr class
    include "../model/dbh.classes.php";
    include "../model/signup.classes.php";
    include "../controller/signup-contr.classes.php";
    $signup = new SignupContr($username, $email, $password, $passwordrepeat, $enabled);

    // Running error handlers and user signup
    $signup->signupUser();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
