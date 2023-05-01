<?php

// Controller class for the resetPassword that handles user input
// Connects to the database trough an instance of the accountDAO class

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';

class resetPasswordController extends Controller
{
    private string $selector;
    private string $validator;
    private string $password;
    private string $passwordrepeat;

    public function __construct($selector, $validator, $password, $passwordrepeat)
    {
        $this->selector = $selector;
        $this->validator = $validator;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/resetPassword.php?selector=" . $this->selector . "&validator=" . $this->validator . "&error=emptyinput");
            exit();
        }
        if ($this->passwordMatch() == false) {
            // echo "Wachtwoorden komen niet overeen.";
            header("location: ../view/resetPassword.php?selector=" . $this->selector . "&validator=" . $this->validator . "&error=passwordmatch");
            exit();
        }
        if ($this->isPasswordStrong() == false) {
            // echo "Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.";
            header("location: ../view/resetPassword.php?selector=" . $this->selector . "&validator=" . $this->validator . "&error=passwordstrength");
            exit();
        }

        // Use PHP built in method to generate a password hash
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        // Run the updatePassword method that verifies the token and updates the password in the db
        $accountDAO = new accountDAO();
        $accountDAO->updatePassword($this->selector, $this->validator, $hashedPassword);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->password) || empty($this->passwordrepeat)) {
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
        // Validate password strength
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);


        $result = null;
        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8 || strlen($this->password) > 32) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
