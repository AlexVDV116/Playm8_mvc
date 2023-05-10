<?php

// Define the namespace of this class
namespace Includes;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Controller\roleController;

// adminEditAccount class that has a form so that an admin can edit a user account

// An include file that runs a PHP script
// Gets the data from the adminEditRole form trough the $_POST method
// Uses this data to instantiate a roleController object
// The roleController will run several server side validations
// If no errors return user to the index page with a success message

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {

    // Grabbing the new data, use htmlspecialchars to convert user input to html entities including single and double quotes
    $newRoleName = htmlspecialchars($_POST["roleName"], ENT_QUOTES, "UTF-8");
    $newRoleDescription = htmlspecialchars($_POST["roleDescription"], ENT_QUOTES, "UTF-8");

    // Array with all rolesID's set in the form checkboxes
    $selectedPermissions = $_POST["selectedPermissions"];

    // Grab the admin password to verify the admin is making the changes
    $adminPassword = htmlspecialchars($_POST["adminPassword"], ENT_QUOTES, "UTF-8");

    // Grab the admin email
    $adminEmail = $_SESSION["auth_user"]["email"];

    // Grab the roleID from the hidden input
    // the roleController uses this to get the role from the DB
    $roleID = $_POST["roleID"];

    // Instantiate the roleController class
    $roleController = new roleController($roleID, $newRoleName, $newRoleDescription, $selectedPermissions);
    $roleController->run();
}
