<?php

require_once '../framework/Controller.php';

// This class performs several error checks on the data the user supplies to us when filling in the contact form
// If there are no errors it will send the information in a format to our e-mailadress
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
        if ($this->emptyInput() == true) {
            // echo "Empty input!";
            header("location: ../view/contact.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == true) {
            // echo "Invalid Email!";
            header("location: ../view/contact.php?error=invalidemail");
            exit();
        }

        // Send data to our contact e-mailadress
        $mailname = $this->name . " " . $this->lastname;

        $to = $this->email;
        $subject = "Contact request from: {$mailname}";
        $message = "<p>Subject: {$this->need}</p>";
        $message .= "<p>{$this->message}</p>";

        $headers = "From: Playm8 <contact@playm8.com>\r\n";
        $headers .= "Reply-To: contact@playm8.com";
        $headers .= "Content-type: text/html\r\n";

        mail($to, $subject, $message, $headers);
    }

    // Method that checks if there are any empty inputs, returns true if any inputs
    private function emptyInput(): bool
    {
        $result = null;
        if (empty($this->name) || empty($this->lastname) || empty($this->email) || empty($this->need) || empty($this->message)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // Method that uses the PHP built-in filter_var with the email filter to check user email input, returns true if invalid
    private function invalidEmail(): bool
    {
        $result = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
