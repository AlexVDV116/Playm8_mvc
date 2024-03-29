<?php

// Define the namespace of this class
namespace View;

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
global $ROOT;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once $ROOT . 'vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use Controller\translatorController;

// footer class that contains the footer
class footer extends View
{

    public function show()
    {
        // Setting the ROOT directory for this file so the relative paths used in included pages will still work
        global $ROOT;

        $translator = new translatorController;
        // Use the getLanguageFile method of the languageSelector and require the correct language file
        require $ROOT . $translator->getLanguageFile();
?>

        <section id="footer-section">
            <div class="row text-center">
                <div class="col">
                    <h4 class="pb-3">
                        <?= $translator->__('Heeft u vragen, problemen of feedback voor ons?') ?>
                    </h4>
                    <p>
                        <?= $translator->__('Contacteer ons via onze socials of gebruik ons ') ?>
                        <a href="<?= $ROOT ?>view/contact.php"><?= $translator->__('contactformulier') ?></a>.
                    </p>
                    <div class="social-container mt-4">
                        <ul class="social-icons">
                            <li><a href="https://instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://github.com/playm8-avans/Playm8_mvc" target="_blank"><i class="fa fa-github"></i></a></li>
                            <li><a href="<?= $ROOT ?>view/contact.php"><i class="fa-regular fa-envelope"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="col text-center mt-3">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col">
                    <a href="https://www.freepik.com/free-photo/wonderful-european-female-model-chilling-with-puppy-indoor-portrait-debonair-girl-enjoying-portraitshoot-with-her-cute-pet_11934743.htm#query=girl%20and%20dog&position=1&from_view=search&track=sph">
                        <?= $translator->__('Afbeelding via') ?> lookstudio</a> <?= $translator->__('op') ?> Freepik <br>
                    <a href="https://www.freepik.com/free-photo/young-stylish-couple-walking-with-dog-street-man-woman-happy-together-with-husky-breed_9699446.htm#query=pet%20walk%202%20people&position=6&from_view=search&track=ais">
                        <?= $translator->__('Afbeelding via') ?> marymarkevich</a> <?= $translator->__('op') ?> Freepik
                </div>
            </div>
        </section>

        <script src="<?php echo $ROOT; ?>assets/js/scripts.js"></script>
        <script src="<?php echo $ROOT; ?>assets/js/features-new.js"></script>
        <script src="<?php echo $ROOT; ?>assets/js/scroll.js"></script>
        <script src="<?php echo $ROOT; ?>assets/js/form.js"></script>
        </body>

        </html>
<?php
    }
}
