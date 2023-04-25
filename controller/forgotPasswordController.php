<?php

require_once '../framework/Controller.php';
require_once '../dao/accountDAO.php';

// This class performs several error checks on the data the user supplies to us when he request to reset his password
// If there are no errors it will instantiate an accountDAO and use its resetPassword method with the supplied user email
class forgotPasswordController extends Controller
{

    private string $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/forgotPassword.php?error=emptyinput");
            exit();
        }
        if ($this->hasInvalidEmail() == true) {
            // echo "Onjuist email format.";
            header("location: ../view/forgotPassword.php?error=invalidemail");
            exit();
        }
        $accountDAO = new accountDAO();
        $accountDAO->resetPassword($this->email);
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->email)) {
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
