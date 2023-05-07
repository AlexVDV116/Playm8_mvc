<?php

// Controller class that handles user input when registering an account
// Connects to the database trough an instance of the accountDAO class

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';
require_once '../model/Mail.php';

class accountController extends Controller
{
    private string $username;
    private string $email;
    private string $password;
    private string $passwordrepeat;

    public function __construct($username, $email, $password, $passwordrepeat)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
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

        // Generate an unique ID with the prefix AID for AccountID
        $accountID = uniqid("AID");

        // Assocaitive array containing the user data
        $data = array(
            "accountID" => $accountID,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $hashedPassword,
            "isBetaUser" => false,
            "isActive" => false,
            "activationCode" => password_hash($activationCode, PASSWORD_DEFAULT),
            "activationExpiry" => $expiryDate,
            "activatedAt" => '',
            "userProfileID" => "UID" . substr($accountID, 3)
        );

        // Create a new empty Account object with the user data
        $account = new Account($data);

        // Insert the account object data into the database accounts table
        $accountDAO->insert($account);

        // Insert default roleID 1 into the accountRoles table
        $accountDAO->setRoleID($account->accountID, [1]);

        // Send email to user with activation code and link to activate the account
        $accountDAO->mailActivationCode($this->email, $activationCode);
    }

    public function editAccount($email, $currentPassword): void
    {
        // Grab the account from the DB
        $accountDAO = new AccountDAO;
        $account = $accountDAO->get($email);

        // use PHP built in method to check if the given password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($currentPassword, $account->getPassword());

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/editAccount.php?error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {

            // Validate user input


            // Compare the new data against the data in the DB and update when changes have occured
            if ($this->username !== $account->getUsername()) {
                // Update username
                $account->username = $this->username;
                $_SESSION["auth_user"]["username"] = $this->username;
            }
            if ($this->email !== $account->getEmail()) {

                // Check if email is valid
                if ($this->hasInvalidEmail() == true) {
                    // echo "Onjuist email format.";
                    header("location: ../view/editAccount.php?error=invalidemail");
                    exit();
                }

                // Check if email is already registered with us
                if ($this->isKnownEmail() == true) {
                    // echo "Email bestaat al in ons bestand.";
                    header("location: ../view/editAccount.php?error=emailalreadyexists");
                    exit();
                }

                // Update email, set account inactive, resent activation mil
                $account->email = $this->email;
                $account->isActive = false;

                // Generate a new activationcode and expirydate
                $activationCode = $accountDAO->generateActivationCode();
                $hashedActivationCode = password_hash($activationCode, PASSWORD_DEFAULT);
                $expiryDate = date("Y-m-d H:i:s", strtotime('+24 hours')); // ExpiryDate = now + 24 hours

                // Set the account object properties to contain the new activationCode and expiryDate
                $account->activationCode = $hashedActivationCode;
                $account->activationExpiry = $expiryDate;

                // Send email to user with activation code and link to activate the account
                $accountDAO->mailActivationCode($this->email, $activationCode);

                $emailChange = true;
            }
            // Check if user actually entered a new password
            if (!empty($this->password)) {

                // Check if these passwords match
                if ($this->passwordMatch() == false) {
                    // echo "Wachtwoorden komen niet overeen.";
                    header("location: ../view/editAccount.php?error=passwordmatch");
                    exit();
                }
                // Check if the passwords follow the passwords rules
                if ($this->isPasswordStrong() == false) {
                    // echo "Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.";
                    header("location: ../view/editAccount.php?error=passwordstrength");
                    exit();
                }

                // Compare the new password to the old password, if it has changed, update the password
                if ($this->password !== $account->getPassword() && $this->passwordrepeat !== $account->getPassword()) {
                    // Update password
                    // Use PHP built in method to generate a password hash
                    $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
                    $account->password = $hashedPassword;
                    $passwordChange = true;
                }
            }

            // Update the database with the new account object 
            $accountDAO->update($account);

            // If the password or email has changed, log user out, redirect to loginpage with success message
            if ($emailChange === true) {
                // When logging out regenerate session id, unset session variables and destroy session to prevent session-fixation by malicious user
                session_start();
                session_regenerate_id();
                session_unset();
                session_destroy();

                // Redirect user back to login page
                header("location: ../view/login.php?emailChange=success");
                exit();
            } elseif ($passwordChange === true) {
                // When logging out regenerate session id, unset session variables and destroy session to prevent session-fixation by malicious user
                session_start();
                session_regenerate_id();
                session_unset();
                session_destroy();

                // Redirect user back to login page
                header("location: ../view/login.php?passwordChange=success");
                exit();
            }

            header("location: ../view/editAccount.php?usernameChange=success");
        }

        // If changes occured, update the DB with the new data
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

    // Method to check if password is strong enough
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
