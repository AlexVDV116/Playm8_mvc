<?php

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

// Class containing PHPMailer email credentials and configuration
class mailConfig
{
    const CONFIG = [
        'email' => [
            'host' => 'smtp.office365.com',
            'port' => 587,
            'username' => 'donotreply-playm8@outlook.com',
            'password' => '',
            'SMTPSecure' => 'tls'
        ]
    ];
}
