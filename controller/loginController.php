<?php

// Controller class that handles user input when logging in as a user
// Connects to the database trough an instance of the accountDAO class

// Server side user input validation when submitting the inlog form data
// Gets the data from the login.inc.php
// If no errors found, instantiates an accountDAO object and runs the getUser method to log the user in

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';

// This class performs several error checks on the data the user supplies to us when logging in
// If there are no errors it will use the getUser method inherited from the Login class
class LoginController extends Controller
{

    private string $email;
    private string $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/login.php?error=emptyinput");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Onjuist email format.";
            header("location: ../view/login.php?error=invalidemail");
            exit();
        }
        $accountDAO = new accountDAO();
        $accountDAO->logInUser($this->email, $this->password);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->email) || empty($this->password)) {
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
}
