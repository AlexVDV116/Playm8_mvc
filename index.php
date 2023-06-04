<?php

/* Echo errors for development purposes */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once 'vendor/autoload.php';

// Import classes this class depends on
use View\header;
use View\footer;
use Controller\translatorController;

$translator = new translatorController;
// Use the getLanguageFile method of the languageSelector and require the correct language file
require $ROOT . $translator->getLanguageFile();

// Include the header
$header = new header();

?>
<section id="hero-section">
    <div class="container hero-section">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">

                <p class="hero-app-text">
                    <?= $translator->__('Binnenkort beschikbaar voor iOS en Android!') ?>
                </p>
                <h1 class="mb-4">
                    <?= $translator->__('De meet-up app voor') ?> <br>
                    <?= $translator->__('jou en je viervoeter') ?>
                </h1>
                <p>
                    <?= $translator->__('Playm8 is de app waarbij je connecties aangaat samen met je huisdier. Swipe, like, chat en ontmoet baasjes en hun huisdieren bij jou in je buurt. Op zoek naar de dichtstbijzijnde dierenvoorziening? Een last minute oppas? Een beschikbare uitlaatservice? Playm8 heeft het.') ?>
                </p>

                <br>
                <div class="download-buttons d-flex flex-row justify-content-start">
                    <?php
                    $buttonLang = $_SESSION['lang'];

                    switch ($buttonLang) {
                        case 'nl':
                            echo "<div><a href=#><img src='https://play.google.com/intl/en_us/badges/static/images/badges/nl_badge_web_generic.png' alt='Ontdek het op Google Play' width='200px' height='78px' /></a></div>";
                            echo "<div class='mx-3'><a href=#><img src='https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/nl-nl?size=250x83&amp;releaseDate=1598227200' alt='Download on the App Store' width='180px' height='78px' ></a></div>";
                            break;
                        case 'en':
                            echo "<div><a href=#><img src='https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png' alt='Get it on Google Play' width='200px' /></a></div>";
                            echo "<div class='mx-3'><a href=#><img src='https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/en-us?size=250x83&amp;releaseDate=1598227200' alt='Download on the App Store' width='180px' height='78px' ></a></div>";
                            break;
                        case 'fr':
                            echo "<div><a href=#><img src='https://play.google.com/intl/en_us/badges/static/images/badges/fr_badge_web_generic.png' alt='Disponible sur Google Play' width='200px' /></a></div>";
                            echo "<div class='mx-3'><a href=#><img src='https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/fr-fr?size=250x83&amp;releaseDate=1598227200' alt='Download on the App Store' width='180px' height='78px' ></a></div>";
                            break;
                        case 'es':
                            echo "<div><a href=#><img src='https://play.google.com/intl/en_us/badges/static/images/badges/es_badge_web_generic.png' alt='Disponible en Google Play' width='200px' /></a></div>";
                            echo "<div class='mx-3'><a href=#><img src='https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/es-es?size=250x83&amp;releaseDate=1598227200' alt='Download on the App Store'width='180px' height='78px' ></a></div>";
                            break;
                        case 'zh':
                            echo "<div><a href=#><img src='https://play.google.com/intl/en_us/badges/static/images/badges/zh-cn_badge_web_generic.png' alt='下载应用，请到 Google Play' width='200px' /></a></div>";
                            echo "<div class='mx-3'><a href=#><img src='https://tools.applemediaservices.com/api/badges/download-on-the-app-store/black/zh-cn?size=250x83&amp;releaseDate=1598227200' alt='Download on the App Store' width='180px' height='78px' ></a></div>";
                            break;
                    }
                    ?>
                </div>

            </div>

            <div class="col-lg-6 order-1 order-lg-2">
                <img class="img-fluid rounded-4 shadow-sm" src="./assets/images/hero-img.jpeg" alt="Banner image">
            </div>

        </div>
    </div>
</section>

<section id="about-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col">
                <img src="./assets/images/paws.png" alt="paws" class="img-fluid paws d-block mx-auto">
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-5 order-1 order-lg-1 gx-5">
                <img class="img-fluid hero-app-image rounded-4" src="./assets/images/data-img.png" alt="Is data image">
            </div>

            <div class="col-lg-7 order-2 order-lg-2 gx-5">
                <h2 class="mb-4">
                    <?= $translator->__('Data tegen eenzaamheid') ?>
                </h2>
                <p>
                    <?= $translator->__('Eenzaamheid is een groot maatschappelijk probleem in Nederland; in een onderzoek van het RIVM uit 2020 gaf maar liefst 47% van de volwassen bevolking (18 jaar en ouder) aan eenzaam te zijn. De cijfers van 85-plussers zijn nog schrikbarender: 66% gaf hier aan zich regelmatig eenzaam te voelen (Eenzaamheid | Infographic, z.d.).') ?>
                </p>
                <p>
                    <?= $translator->__('De visie van Playm8 is om eenzaamheid in onze maatschappij met behulp van technologie en data te reduceren. Onze organisatie hecht waarde aan vriendschap en verbinding in het leven. Het is altijd fijn om een persoon in je leven te hebben die jou kan laten lachen zelfs als diegene niet bij je is.') ?>
                </p>
                <p>
                    <?= $translator->__('Het leven draait niet om wat je hebt, maar om wie je hebt, dat is wat telt.') ?>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="features-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-5"><?= $translator->__('Features') ?></h2>
            </div>
        </div>
        <div id="outsider" class="d-flex flex-row flex-nowrap features-row">
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-map-location"></i>
                </div>
                <h4><?= $translator->__('Alles voor je dier op de wandelkaart') ?></h4>
                <p><?= $translator->__('Krijg snel inzichtelijk waar de dichtstbijzijnde hondentrimmer of hondenuitlaatplaats te vinden is.') ?>
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-paw"></i>
                </div>
                <h4><?= $translator->__('In-app oppas en uitlaatservice') ?></h4>
                <p><?= $translator->__('Op zoek naar een uitlaatservice? Of een service aanbieden? Kom in contact met elkaar.') ?>
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-dog"></i>
                </div>
                <h4><?= $translator->__('Een (gezond) maatje voor het leven') ?></h4>
                <p><?= $translator->__('Dieren die bewegen blijven fit en gezond. Voldoende beweging houdt de spieren en botten sterk, zorgt ervoor dat het hart en de longen gezond blijven en voorkomt overgewicht.') ?>
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-map-location"></i>
                </div>
                <h4><?= $translator->__('Alles voor je dier op de wandelkaart') ?></h4>
                <p><?= $translator->__('Krijg snel inzichtelijk waar de dichtstbijzijnde hondentrimmer of dierenarts te vinden is.') ?>
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-regular fa-comments"></i>
                </div>
                <h4><?= $translator->__('Chat en maak nieuwe vrienden') ?></h4>
                <p><?= $translator->__('Chat met huisdiereigenaren in de buurt en maak nieuwe vrienden.') ?>
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-regular fa-hospital"></i>
                </div>
                <h4><?= $translator->__('Vind de dichtsbijzijnde dierenarts') ?></h4>
                <p><?= $translator->__('Vind en kom gemakkelijk in contact met verschillende dierenartspraktijken in uw buurt.') ?>
                </p>
            </div>


        </div>
        <br>
        <div class="dot-navigation">
            <div class="d-flex flex-row flex-nowrap">
                <button id="button-left" type="button" onclick="scrollLft()">
                    <i class="fa-solid fa-angles-left"></i></button>

                <button type="button" onclick="scrollFarLeft()">
                    <div class="dot-navigation__item dot_item_1 active-dot">
                </button>

                <button type="button" onclick="scrollMiddle()">
                    <div class="dot-navigation__item dot_item_1">
                </button>

                <button type="button" onclick="scrollFarRight()">
                    <div class="dot-navigation__item dot_item_1">
                </button>

                <button id="button-right" type="button" onclick="scrollRight()">
                    <i class="fa-solid fa-angles-right"></i></button>
            </div>
        </div>
</section>

<section id="impression-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-5"><?= $translator->__('Impressie') ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <img class="img-fluid" src="./assets/images/impressie.png" alt="impressie">
            </div>
        </div>
    </div>
</section>

<section id="credits-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-5"><?= $translator->__('Credits') ?></h2>
            </div>
        </div>

        <div class="row">
            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted"><?= $translator->__('Pakket 1') ?></h6>
                        <h5 class="card-title"><?= $translator->__('Chihuahua') ?>Chihuahua</h5>
                        <h1>&euro;2,50</h1>
                        <p class="card-text"><?= $translator->__('Maximaal 50 swipes per 24 uur') ?>
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">
                            <?= $translator->__('Binnenkort verkrijgbaar') ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted"><?= $translator->__('Pakket 2') ?></h6>
                        <h5 class="card-title"><?= $translator->__('Labrador') ?></h5>
                        <h1>&euro;5,00</h1>
                        <p class="card-text"><?= $translator->__('Maximaal 150 swipes per 24 uur') ?><br>
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">
                            <?= $translator->__('Binnenkort verkrijgbaar') ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted"><?= $translator->__('Pakket 3') ?></h6>
                        <h5 class="card-title"><?= $translator->__('Pitbull') ?></h5>
                        <h1>&euro;7,50</h1>
                        <p class="card-text"><?= $translator->__('Onbeperkt aantal swipes') ?> <br>
                            <?= $translator->__('Reclamevrij') ?>
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">
                            <?= $translator->__('Binnenkort verkrijgbaar') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="tester-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-row justify-content-center">
                <div class="container register-form">
                    <h2><?= $translator->__('Registreer je nu!') ?></h2>
                    <form action="<?php echo $ROOT; ?>includes/betaform.inc.php" method="post" class="needs-validation" novalidate>
                        <div class="col">
                            <input type="text" class="form-control mt-5 border-0" id="name" name="name" placeholder="<?= $translator->__('Gebruikersnaam') ?>" required>
                            <div class="invalid-feedback">
                                <?= $translator->__('Dit veld is verplicht') ?>
                            </div>
                        </div>
                        <div class="col">
                            <input type="email" class="form-control mt-2 border-0" id="email" name="email" placeholder="<?= $translator->__('E-mailadres') ?>" required>
                            <div class="invalid-feedback">
                                <?= $translator->__('Voer een geldig e-mailadres in.') ?>
                            </div>
                        </div>
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" role="switch" name="privacy-policy" id="privacy-policy" value="agreed" required>
                            <label class="form-check-label" for="privacy-policy">
                                <?= $translator->__('Ik ga akkoord met het ') ?><a href="./view/privacy-policy.php" target=”_blank”><?= $translator->__('privacy beleid.') ?></a>.
                            </label>
                            <div class="invalid-feedback">
                                <?= $translator->__('U dient akkoord te gaan met ons privacy beleid.') ?>
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="terms-and-conditions" id="terms-and-conditions" value="agreed" required>
                            <label class="form-check-label" for="terms-and-conditions">
                                <?= $translator->__('Ik ga akkoord met de ') ?><a href="./view/terms-and-conditions.php" target="_blank"><?= $translator->__('algemene voorwaarden.') ?></a>.
                            </label>
                            <div class="invalid-feedback">
                                <?= $translator->__('U dient akkoord te gaan met onze algemene voorwaarden.') ?>
                            </div>
                        </div>
                        <div class="alert alert-success register-success d-none" role="alert">
                            <?= $translator->__('Bedankt voor uw registratie.') ?>
                        </div>
                        <div class="form-button-row d-flex flex-row mt-3">
                            <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit"><?= $translator->__('Verzenden') ?></button>
                        </div>
                        <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput") {
                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>' . $translator->__('Alle velden zijn verplicht.') . '</p>';
                            }
                            if ($_GET["error"] == "invalidemail") {
                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>' . $translator->__('Onjuist e-mail format.') . '</p>';
                            }
                            if ($_GET["error"] == "unknownuser") {
                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>' . $translator->__('Dit e-mailadres is niet bij ons bekend.') . '</p>';
                            }
                            if ($_GET["error"] == "alreadybeta") {
                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>' . $translator->__('Dit account staat al geregistreerd als beta-tester.') . '</p>';
                            }
                            if ($_GET["error"] == "accountdisabled") {
                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>' . $translator->__('Dit account is inactief.') . '.</p>';
                            }
                        }
                        if (isset($_GET["beta"])) {
                            if ($_GET["beta"] == "success") {
                                echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i>' . $translator->__('Bedankt voor je inschrijving als betatester.') . '<br>' . $translator->__('Wij behandelen je verzoek zo snel mogelijk.') . '</p>';
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <h2><?= $translator->__('Meld je aan en wordt Betatester!') ?></h2>
                <p><?= $translator->__('Bij Playm8 zijn wij op zoek naar mensen met voldoende analytisch denkvermogen en affiniteit met IT die Beta-tester willen worden. Met ons Beta-test programma willen wij de functionaliteit en de bruikbaarheid van onze mobiele applicatie testen. Issues en bugs worden direct met onze software-ontwikkelaars teruggekoppeld wat bijdraagt aan de kwaliteit van ons product.') ?></p>
                <p><?= $translator->__('Meld je aan met de gebruikersnaam en het e-mailadres van je Playm8 account!') ?></p>
            </div>
        </div>
    </div>
</section>
<?php
// Include the footer
$footer = new footer();
