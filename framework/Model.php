<?php

// Define the namespace of this class
namespace Framework;

class Model
{

    /* constructor can be used in thee ways:
     * 1. create empty object, when called with new..()
     * 2. create from database record by PDO::fetchObject called from DAO 
     *      which copies fields from database record BEFORE construction!
     * 3. create from assosciative array like new..($_POST) 
     *      to copy fields from posted form
     */
    public function __construct(?array $form)
    {
        if (!empty($form)) {
            foreach ($form as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }
}
