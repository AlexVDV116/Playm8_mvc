<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use Model\Mail;
use Data\mailConfig;

// Controller class that handles user input when using the contact form
// Gets the data from the contactform.inc.php
// If no errors found, sends an e-mail to the Playm8 e-mailadress with the data using PHPMailer plugin
// Sends an additional email to the client confirming that his contact support is being processed

class contactFormController extends Controller
{

    private string $name;
    private string $lastname;
    private string $email;
    private string $need;
    private string $message;

    public function __construct($name, $lastname, $email, $need, $message)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->need = $need;
        $this->message = $message;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/contact.php?error=emptyinput");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Onjuist email format.";
            header("location: ../view/contact.php?error=invalidemail");
            exit();
        }
        if ($this->getMessageLength() < 20 || $this->getMessageLength() > 500) {
            // echo "Uw bericht moet tussen de 20 tot 500 karakters bevatten!";
            header("location: ../view/contact.php?error=messagelength");
            exit();
        }

        // Send the data from the contact form to our email-adress so we can process the support request
        $mailname = $this->name . " " . $this->lastname;

        $senderName = "Playm8 Contact Form";
        $senderEmail = mailConfig::CONFIG['email']['username'];
        $senderEmailPassword = mailConfig::CONFIG['email']['password'];

        $recieverEmail = mailConfig::CONFIG['email']['username'];
        $subject = "Contact request from: {$mailname}";
        $body = "<p>Sent by: {$this->email}<br>";
        $body .= "Subject: {$this->need}</p>";
        $body .= "<p><strong>{$mailname} has requested to contact us trough our contact form.</strong></p>";
        $body .= "<p>{$this->message}</p>";

        $playm8Mail = new Mail($senderName, $senderEmail, $senderEmailPassword);
        $playm8Mail->sendMail($recieverEmail, $subject, $body);

        // Send a copy of the contact support to the client as a confirmation mail that his request is being processed

        $recieverEmail = $this->email;
        $subject = "Your contact request from is being processed";
        $body = "<p><strong>Thank you for contacting us, {$mailname}.</strong><br>";
        $body .= "Your contact request: {$this->need} is being processed, we will do our best to reach out to you as soon as possible.<br><br>";
        $body .= "A copy of your message is attached below:</p>";
        $body .= "<p>{$this->message}</p>";

        $clientMail = new Mail($senderName, $senderEmail, $senderEmailPassword);
        $clientMail->sendMail($recieverEmail, $subject, $body);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->name) || empty($this->lastname) || empty($this->email) || empty($this->need) || empty($this->message)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // Method that uses the PHP built-in filter_var method to check user email input: returns true if invalid email given
    private function hasInvalidEmail(): bool
    {
        $result = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // Method that uses the strlen() method to return the bytes in a string (including whitespace and special characters)
    private function getMessageLength(): int
    {
        return strlen($this->message);
    }
}
