<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;

// Home class that displays various messages to the administrator.

class adminHome extends View
{

    public function show()
    {
?>
        <h4>Welkom, <?php echo $_SESSION["auth_user"]["username"] ?></h4>
        <p>Selecteer een van de administrator functionaliteiten.</p>

<?php
    }
}
new adminHome();
