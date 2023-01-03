<?php

require_once '../framework/Controller.php';

// This class performs several error checks on the data the user supplies to us when signing up as beta user
// If there are no errors it will set the account_beta_user param to true and update the account info in the database
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
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Invalid Email!";
            header("location: ../index.php?error=invalidemail");
            exit();
        }
        if ($this->isKnownEmail() == false) {
            // echo "User unknown!";
            header("location: ../index.php?error=unknownuser");
            exit();
        }
        if ($this->isAlreadyBeta() == true) {
            // echo "User already signed up as a beta user!";
            header("location: ../index.php?error=alreadybeta");
            exit();
        }
        if ($this->isAccountEnabled() == false) {
            // echo "User account disabled";
            header("location: ../index.php?error=accountdisabled");
            exit();
        }

        // Create an account DAO
        $accountDAO = new accountDAO();
        $accountDAO->startList();

        // Get the account information from database (accountDAO extends DAO and DAO will construct a Account Model)
        $account = $accountDAO->get($this->email);

        // Set account_beta_user collum to true
        $account->account_beta_user = true;

        // Update the account info and store in database
        $accountDAO->update($account);
    }

    // Method that checks if there are any empty inputs, returns true if any inputs
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

    // Method that uses the PHP built-in filter_var with the email filter to check user email input, returns true if invalid
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

    // Use accountDAO method because it accesses the database
    // Check database for already registered email returns true if email already found
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

    // Method that uses the PHP built-in filter_var with the email filter to check user email input, returns true if invalid
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
