<?php

// This class performs several error checks on the data the user supplies to us when logging in
// If there are no errors it will use the getUser method inherited from the Login class
class LoginContr extends Login
{

    private string $email;
    private string $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    // Method that calls the emptyInput method and if true exectue header and exit code else getUser
    public function loginUser(): void
    {
        if ($this->emptyInput() == true) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        $this->getUser($this->email, $this->password);
    }

    // Method that checks for empty input returns bool
    private function emptyInput(): bool
    {
        $result = null;
        if (empty($this->email) || empty($this->password)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}
