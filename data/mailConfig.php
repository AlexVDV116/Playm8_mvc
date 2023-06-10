<?php

// Define the namespace of this class
namespace Data;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Class containing PHPMailer email credentials and configuration
class mailConfig
{
    const CONFIG = [
        'email' => [
            'host' => 'smtp.office365.com',
            'port' => 587,
            'username' => 'donotreply-playm8@outlook.com',
            'password' => 'Wachtwoord1!',
            'SMTPSecure' => 'tls'
        ]
    ];

    // Fill in your localhost APP URL in order to get right activation link in the accountDAO mailActivationCode method
    const APP_URL = 'http://localhost/Coding_projects/GitHub%20Repositories/Playm8_mvc/';
}
