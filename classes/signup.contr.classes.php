<?php

class SignupContr
{

    private string $email;
    private string $password;
    private string $passwordrepeat;

    function __construct($email, $password, $passwordrepeat)
    {
        $this->email = $email;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->email) || empty($this->password) || empty($this->passwordrepeat)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
