<?php

class LoginContr extends Login
{

    private string $email;
    private string $password;

    function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    // Method that calls the emptyInput method and if true exectue header and exit code else getUser
    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        $this->getUser($this->email, $this->password);
    }

    // Method that checks for empty input returns bool
    private function emptyInput()
    {
        $result = null;
        if (empty($this->email) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
