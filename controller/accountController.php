<?php

// Server side user input validation when signing up.
// Creates an empty Account object
// Instantiates an accountDAO object
// Uses the insert method to insert the user data into the database

session_start();

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';
require_once '../model/Mail.php';

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
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/signup.php?error=emptyinput");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Onjuist email format.";
            header("location: ../view/signup.php?error=invalidemail");
            exit();
        }
        if ($this->isKnownEmail() == true) {
            // echo "Email bestaat al in ons bestand.";
            header("location: ../view/signup.php?error=emailalreadyexists");
            exit();
        }
        if ($this->passwordMatch() == false) {
            // echo "Wachtwoorden komen niet overeen.";
            header("location: ../view/signup.php?error=passwordmatch");
            exit();
        }
        if ($this->isPasswordStrong() == false) {
            // echo "Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.";
            header("location: ../view/signup.php?error=passwordstrength");
            exit();
        }

        // Use PHP built in method to generate a password hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Instantiate an accountDAO object
        // Generate an activation code for email activation
        // Generate an expiry date that is now + 24 hours for the activation code expiry date
        $accountDAO = new accountDAO();
        $activationCode = $accountDAO->generateActivationCode();
        $expiryDate = date("Y-m-d H:i:s", strtotime('+24 hours')); // ExpiryDate = now + 24 hours

        // Assocaitive array containing the user data
        $data = array(
            "username" => $this->username,
            "email" => $this->email,
            "password" => $hashedPassword,
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => password_hash($activationCode, PASSWORD_DEFAULT),
            "activationExpiry" => $expiryDate,
            "activatedAt" => '',
            "roles" => [],
            "userProfile" => null
        );

        // Create a new empty Account object with the user data
        $account = new Account($data);

        // Insert the account object data into the database
        $accountDAO->insert($account);

        // Send email to user with activation code and link to activate the account
        $accountDAO->mailActivationCode($this->email, $activationCode);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->passwordrepeat)) {
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

    // Method to check if both password fields input match: return true if they match
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

    // Method to check if both password fields input match: return true if they match
    private function isPasswordStrong(): bool
    {
        // Validate password strenght
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);


        $result = null;
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8 || strlen($this->password) > 32) {
            $result = false;
        } else {
            $result = true;
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
}
