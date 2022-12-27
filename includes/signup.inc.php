<?php
// .inc refers to that this is an include file - naming convention
// this means that the user does not see the file it just has a basic php script that runs

if (isset($_POST["submit"])) {

    // Grabbing the data
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordrepeat = $_POST["passwordrepeat"];

    // Instantiate the SignupContr class
    include "../classes/dbh.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($email, $password, $passwordrepeat);

    // Running error handlers and user signup
    $signup->signupUser();

    // Redirect user back to the front page when sucsessfull
    header("location: ../index.php?error=none");
}
