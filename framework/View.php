<?php

// Define the namespace of this class
namespace Framework;

abstract class View
{

    abstract function show();

    public function __construct()
    {
        $this->show();
    }
}
