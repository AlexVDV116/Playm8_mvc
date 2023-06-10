<?php

// Define the namespace of this class
namespace Data;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Rename this file, or create a new file named secret.php
// Copy this template to to 'secret.php' and fill in your own database credentials and mail configuration
// Make sure the name 'secret.php' is in .gitignore

// Class containing database credentials
class Secret
{
    const DB_HOST = 'localhost';
    const DB_NAME = 'playm8';
    const DB_USERNAME = 'root';
    const DB_PASSWORD = '';
    const DB_ADMIN = 'https://localhost/phpmyadmin';
}
