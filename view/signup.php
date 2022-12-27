<?php
$ROOT = '../'; // Setting the ROOT directory so the relative path in the included header.php will still work
include_once '../header.php';
?>

<section>
    <div class="container">
        <div class="text-center mt-2">
            <h1>Registratieformulier</h1>
        </div>
        <form action="../includes/signup.inc.php" method="post">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="passwordrepeat" placeholder="Password">
            <button type="submit" name="submit">Registreer</button>
        </form>
    </div>
</section>

<?php
include_once '../footer.php';
?>