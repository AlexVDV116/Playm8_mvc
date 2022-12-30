<?php

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';

class accountController extends Controller
{
    private string $username;
    private string $email;
    private string $password;
    private string $passwordrepeat;
    private bool $enabled;

    public function __construct($username, $email, $password, $passwordrepeat, $enabled)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
        $this->enabled = $enabled;
    }

    public function run(): void
    {
        if ($this->emptyInput() == true) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == true) {
            // echo "Invalid Email!";
            header("location: ../index.php?error=invalidemail");
            exit();
        }
        if ($this->emailTakenCheck() == true) {
            // echo "Email already exists in our database!";
            header("location: ../index.php?error=emailalreadyexists");
            exit();
        }
        if ($this->passwordMatch() == false) {
            // echo "Passwords do not match!";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        // Use PHP built in method to generate a password hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Create a new empty Account object
        $account = new Account();

        $account->account_username = $this->username;
        $account->account_email = $this->email;
        $account->account_password = $hashedPassword;
        $account->account_enabled = 1;

        $accountDAO = new accountDAO();
        $accountDAO->insert($account);
    }


    // Method that checks if there are any empty inputs, returns true if any inputs
    private function emptyInput(): bool
    {
        $result = null;
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->passwordrepeat)) {
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

    // Method to check if both password fields input match return true if they match
    private function passwordMatch(): bool
    {
        $result = null;
        if ($this->password !== $this->passwordrepeat) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Use accountDAO method because it accesses the database
    // Check database for already registered email returns true if email already found
    private function emailTakenCheck(): bool
    {
        $result = null;
        $accountDAO = new accountDAO;
        if ($accountDAO->checkEmail($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
