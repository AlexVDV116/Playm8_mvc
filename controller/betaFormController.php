<?php

// Server side user input validation when signing up as a beta user
// Instantiates an accountDAO object
// Retrieves the user information from the database
// Set the account_beta_user table to true
// Use the accountDAO update method to update the data in the database

require_once '../framework/Controller.php';

class betaFormController extends Controller
{

    private string $name;
    private string $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../index.php?error=emptyinput#tester-section");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Onjuist email format.";
            header("location: ../index.php?error=invalidemail#tester-section");
            exit();
        }
        if ($this->isKnownEmail() == false) {
            // echo "Dit e-mailadres is niet bij ons bekend.";
            header("location: ../index.php?error=unknownuser#tester-section");
            exit();
        }
        if ($this->isAlreadyBeta() == true) {
            // echo "Dit account staat al ingeschreven als beta-tester.";
            header("location: ../index.php?error=alreadybeta#tester-section");
            exit();
        }
        if ($this->isAccountEnabled() == false) {
            // echo "Dit account is inactief.";
            header("location: ../index.php?error=accountdisabled#tester-section");
            exit();
        }

        // Instantiate an account DAO
        $accountDAO = new accountDAO();
        $accountDAO->startList();

        // Get the account information from database (accountDAO extends DAO and DAO will construct a new Account object)
        $account = $accountDAO->get($this->email);

        // Set account_beta_user collum to true
        $account->account_beta_user = true;

        // Update the account info and store in database
        $accountDAO->update($account);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->name) || empty($this->email)) {
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

    // Method that uses the accountDAO knownEmail method because it has to access the database
    // Checks if a record with this email is already known in our database: returns true if email found
    private function isKnownEmail(): bool
    {
        $result = null;
        $accountDAO = new accountDAO;
        if ($accountDAO->knownEmail($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    // Method that uses the accountDAO isBeta method because it has to access the database
    // Checks if a record with this email AND account_beta_user set to true exists in our database: returns true if record found
    private function isAlreadyBeta(): bool
    {
        $result = null;
        $accountDAO = new accountDAO;
        if ($accountDAO->isBeta($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }


    // Method that uses the accountDAO isEnabled method because it has to access the database
    // Checks if a record with this email AND account_enabled set to false is known in our database: returns true if record found
    private function isAccountEnabled(): bool
    {
        $result = null;
        $accountDAO = new accountDAO;
        if ($accountDAO->isEnabled($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
