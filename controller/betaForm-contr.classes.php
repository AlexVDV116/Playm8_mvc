<?php

// This class performs several error checks on the data the user supplies to us when signing up
// If there are no errors it will use the setUser method inherited from the Signup class
class betaFormContr extends betaForm
{

    private string $name;
    private string $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function betaUserChecks(): void
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

        $this->signUpBetaUser($this->name, $this->email);
    }

    // Method that checks if there are any empty inputs, returns true if any inputs
    private function emptyInput(): bool
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

    // Check database for already registered email returns true if email already found
    private function emailTakenCheck(): bool
    {
        $result = null;
        if ($this->checkEmail($this->email)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
