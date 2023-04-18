<?php

// Server side user input validation when submitting the contact form
// Gets the data from the contactform.inc.php
// If no errors found, send mail to Playm8 e-mailadress (WIP needs to be tested)

require_once '../framework/Controller.php';

error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

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

        // Send data to our contact e-mailadress (WIP needs to be tested)
        $mailname = $this->name . " " . $this->lastname;

        $to = $this->email;
        $subject = "Contact request from: {$mailname}";
        $message = "<p>Subject: {$this->need}</p>";
        $message .= "<p>{$this->message}</p>";

        $headers = "From: Playm8 <contact@playm8.com>\r\n";
        $headers .= "Reply-To: contact@playm8.com";
        $headers .= "Content-type: text/html, charset='utf-8'\r\n";

        mail($to, $subject, $message, $headers);
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
