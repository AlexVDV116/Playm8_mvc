<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use DAO\accountDAO;
use PDO;

// Server side user input validation when submitting the inlog form data
// Gets the data from the login.inc.php
// If no errors found, instantiates an accountDAO object and runs the getUser method to log the user in

class loginController extends Controller
{

    private string $email;
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    // Method that checks if the account exists in our database
    // If true, check if password matches the hashed password in our database
    // If true log user in 
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
        $account = $accountDAO->get($this->email);

        // If query gets no result exit script and redirect user to index with error message
        if (!$account) {
            // echo "Onbekend e-mailadres..";
            header("location: ../view/login.php?error=accountnotfound");
            exit();
        };

        $accountID = $account->get("accountID");

        // use PHP built in method to check if the given password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($this->password, $account->get("password"));

        // If the passwords do not match
        if ($checkPwd == false) {

            // Add a + 1 to the failedLoginAttempts collum
            $accountDAO->addFailedLoginAttempt($accountID);

            // Check if the failedLoginAttempts value >= 3
            if ($accountDAO->getFailedLoginAttempts($accountID) >= 3) {
                $accountDAO->disableAccount($accountID);

                // echo "Account geblokkeerd wegens te veel foutieve inlogpogingen.";
                header("location: ../view/login.php?error=blockedaccount");
                exit();
            } else {
                // echo "Onjuist wachtwoord.";
                header("location: ../view/login.php?error=wrongpassword");
                exit();
            }
            // If the password is correct
        } elseif ($checkPwd == true) {


            // If the account is disabled check if there was a last login attemp,
            // If true check if it was longer then 30 mins ago, else redirect with account not activate message
            if ($accountDAO->isActive($this->email) === false) {
                if ($accountDAO->getLastLoginAttempt($accountID) === null) {
                    // echo "Account niet geactiveerd";
                    header("location: ../view/login.php?error=accountnotactivated");
                    exit;
                } else {

                    if (strtotime($accountDAO->getLastLoginAttempt($accountID)) < strtotime("-30 minutes")) {
                        // Remove record from loginAttempts, set account active and log in user
                        $accountDAO->resetFailedLoginAttempts($accountID);
                        $accountDAO->enableAccount($accountID);
                        $account->set("isActive", true);
                    } else {
                        // echo "Account geblokkeerd wegens te veel foutieve inlogpogingen.";
                        header("location: ../view/login.php?error=blockedaccount");
                        exit();
                    }
                }
            } else {
                $accountDAO->resetFailedLoginAttempts($accountID);
            }

            // Prepared satement that selects all rows in the accounts table where user credentials match the given credentials
            $stmt = $accountDAO->prepare('CALL logInAccount(?, ?)');

            // If they do not match, set statement to null and redirect user to index with error message
            if (!$stmt->execute([$this->email, $account->get("password")])) {
                $stmt = null;
                // echo "Onjuist wachtwoord.";
                header("location: ../view/login.php?error=wrongpassword");
                exit;
            };

            // Check if the user has verified its email-adress and that his account isActive = 1
            if ($account->get("isActive") == 0) {
                // echo "Account niet geactiveerd";
                header("location: ../view/login.php?error=accountnotactivated");
                exit();
            };

            // Before logging in the user check if the database query retrieves any results
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../view/login.php?error=accountnotfound");
                exit();
            };

            // Log user in
            // Create a user variable with the results from the statement and return these results in an associative array
            // This user variable now contains all data from the database belonging to the account
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Free up the connection to the server so that other SQL statements may be issued
            $stmt->closeCursor();

            // Create a new session 
            session_start();
            // Regenerate session id to prevent session fixation-by malicious user
            session_regenerate_id();

            // Set session super global variables containing user information
            $_SESSION["auth"] = true;
            $_SESSION["auth_role"] = $accountDAO->getRoleID($account->get("accountID"));
            $_SESSION["auth_user"] = [
                'accountID' => $user[0]["accountID"],
                'username' => $user[0]["username"],
                'email' => $user[0]["email"],
                'isActive' => $user[0]["isActive"],
                'isBetaUser' => $user[0]["isBetaUser"],
                'userProfileID' => $user[0]["userProfileID"],
            ];
        }
        $stmt = null;
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
