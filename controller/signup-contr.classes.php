<?php

// This class performs several error checks on the data the user supplies to us when signing up
// If there are no errors it will use the setUser method inherited from the Signup class
class SignupContr extends Signup
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

    public function signupUser(): void
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if ($this->invalidEmail() == false) {
            // echo "Invalid Email!";
            header("location: ../index.php?error=invalidemail");
            exit();
        }
        if ($this->emailTakenCheck() == false) {
            // echo "Email already exists in our database!";
            header("location: ../index.php?error=emailalreadyexists");
            exit();
        }
        if ($this->passwordMatch() == false) {
            // echo "Passwords do not match!";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        $this->setUser($this->username, $this->email, $this->password);
    }

    private function emptyInput(): bool
    {
        $result = null;
        if (empty($this->username) || empty($this->email) || empty($this->password) || empty($this->passwordrepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Method that uses the PHP built-in filter_var with the email filter to check user email input
    private function invalidEmail(): bool
    {
        $result = null;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Method to check if both password fields input match
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

    private function emailTakenCheck(): bool
    {
        $result = null;
        if (!$this->checkEmail($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
