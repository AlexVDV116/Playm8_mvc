<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;

// Home class that displays various messages to the administrator.

class home extends View
{

    public function show()
    {
?>
        <h4>Admin Home</h4>
        <p>Selecteer een van de administrator functionaliteiten.</p>

<?php
    }
}
new home;
