<?php

// Define the namespace of this class
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Controller\permissionController;

// adminEditAccount class that has a form so that an admin can edit a user account

// An include file that runs a PHP script
// Gets the data from the adminEditPermission form trough the $_POST method
// Uses this data to instantiate a permissionController object
// The permissionController will run several server side validations
// If no errors return user to the index page with a success message

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $permissionID = NULL;
    $permissionName = htmlspecialchars($_POST["permissionName"], ENT_QUOTES, "UTF-8");
    $permissionDescription = htmlspecialchars($_POST["permissionDescription"], ENT_QUOTES, "UTF-8");

    // Grab the admin password to verify the admin is making the changes
    $adminPassword = htmlspecialchars($_POST["adminPassword"], ENT_QUOTES, "UTF-8");

    // Grab the admin email
    $adminEmail = $_SESSION["auth_user"]["email"];

    // Instantiate the permissionController class
    $permissionController = new permissionController($permissionID, $permissionName, $permissionDescription);
    $permissionController->adminAddPermission($adminEmail, $adminPassword);
}
