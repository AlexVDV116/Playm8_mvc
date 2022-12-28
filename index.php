<?php
$ROOT = './'; // Setting the ROOT directory for this file so the relative paths used in included pages will still work
include_once 'header.php';
?>

<section id="hero-section">
    <div class="container hero-section">
        <div class="row">
            <div class="col-lg-6 order-2 order-lg-1">

                <p class="hero-app-text">
                    Binnenkort beschikbaar voor iOS en Android
                </p>
                <h1 class="mb-4">
                    De meet-up app voor <br>
                    jou en je viervoeter
                </h1>
                <p>
                    Playm8 is de app waarbij je connecties aangaat samen met je huisdier. Swipe, like, chat en
                    ontmoet baasjes en hun huisdieren bij jou in je buurt. Op zoek naar de dichtstbijzijnde
                    dierenvoorziening? Een last minute oppas? Een beschikbare uitlaatservice? Playm8 heeft het.
                </p>

                <br>
                <div class="download-buttons d-flex flex-row justify-content-start">
                    <a href="./index.html#">
                        <img class="ios-button" src="./assets/images/Download_on_the_App_Store_Badge_US-UK_RGB_blk_092917.svg" alt="Download-apple-store">
                    </a>

                    <a href="./index.html#" class="mx-3">
                        <img class="android-button" src="./assets/images/Google_Play_Store_badge_EN.svg" alt="Download-play-store">
                    </a>
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
                    Data tegen eenzaamheid
                </h2>
                <p>
                    Eenzaamheid is een groot maatschappelijk probleem in Nederland; in een onderzoek van het RIVM
                    uit 2020 gaf maar liefst 47% van de volwassen bevolking (18 jaar en ouder) aan eenzaam te zijn.
                    De cijfers van 85-plussers zijn nog schrikbarender: 66% gaf hier aan zich regelmatig eenzaam te
                    voelen (Eenzaamheid | Infographic, z.d.).
                </p>
                <p>
                    De visie van Playm8 is om eenzaamheid in onze maatschappij met behulp van technologie en data te
                    reduceren. Onze organisatie hecht waarde aan vriendschap en verbinding in het leven. Het is
                    altijd fijn om een persoon in je leven te hebben die jou kan laten lachen zelfs als diegene niet
                    bij je is.
                </p>
                <p>
                    Het leven draait niet om wat je hebt, maar om wie je hebt, dat is wat telt.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="features-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="text-center mb-5">Features</h2>
            </div>
        </div>
        <div id="outsider" class="d-flex flex-row flex-nowrap features-row">
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-map-location"></i>
                </div>
                <h4>Alles voor je dier op de wandelkaart</h4>
                <p>Krijg snel inzichtelijk waar de dichtstbijzijnde hondentrimmer of hondenuitlaatplaats te vinden
                    is.
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-paw"></i>
                </div>
                <h4>In-app oppas en uitlaatservice</h4>
                <p>Op zoek naar een uitlaatservice? Of een service aanbieden? Kom in contact met elkaar.
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-dog"></i>
                </div>
                <h4>Een (gezond) maatje voor het leven</h4>
                <p>Dieren die bewegen blijven fit en gezond. Voldoende beweging houdt de spieren en botten sterk,
                    zorgt ervoor dat het hart en de longen
                    gezond blijven en voorkomt overgewicht.
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-solid fa-map-location"></i>
                </div>
                <h4>Alles voor je dier op de wandelkaart</h4>
                <p>Krijg snel inzichtelijk waar de dichtstbijzijnde hondentrimmer of dierenarts te vinden is.
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-regular fa-comments"></i>
                </div>
                <h4>Chat en maak nieuwe vrienden</h4>
                <p>Chat met huisdiereigenaren in de buurt en maak nieuwe vrienden.
                </p>
            </div>
            <div class="card card-block text-center">
                <div class="feature-icon">
                    <i class="fa-regular fa-hospital"></i>
                </div>
                <h4>Vind de dichtsbijzijnde dierenarts</h4>
                <p>Vind en kom gemakkelijk in contact met verschillende dierenartspraktijken in uw buurt.
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
                <h2 class="text-center mb-5">Impressie</h2>
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
                <h2 class="text-center mb-5">Credits</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted">Pakket 1</h6>
                        <h5 class="card-title">Chihuahua</h5>
                        <h1>&euro;2,50</h1>
                        <p class="card-text">Maximaal 50 swipes per 24 uur
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">Binnenkort
                            verkrijgbaar
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted">Pakket 2</h6>
                        <h5 class="card-title">Labrador</h5>
                        <h1>&euro;5,00</h1>
                        <p class="card-text">Maximaal 150 swipes per 24 uur <br>
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">Binnenkort
                            verkrijgbaar
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-10 col-lg-4 mx-auto d-flex">
                <div class="card mx-auto">
                    <div class="card-body text-center d-flex flex-column">
                        <h6 class="card-subtitle mb-2 text-muted">Pakket 3</h6>
                        <h5 class="card-title">Pitbull</h5>
                        <h1>&euro;7,50</h1>
                        <p class="card-text">Onbeperkt aantal swipes <br>
                            Reclamevrij
                        </p>
                        <button class="btn btn-lg btn-credits shadow-sm mt-auto mb-2">Binnenkort verkrijgbaar
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
                    <h2>Registreer je nu!</h2>
                    <form class="needs-validation" novalidate>
                        <div class="col">
                            <input type="text" class="form-control mt-5 border-0" id="naam" placeholder="Naam" required>
                            <div class="invalid-feedback">
                                Dit veld is verplicht.
                            </div>
                        </div>
                        <div class="col">
                            <input type="email" class="form-control mt-2 border-0" id="email" placeholder="E-mail" required>
                            <div class="invalid-feedback">
                                Voer een geldig email-adress in.
                            </div>
                        </div>
                        <div class="form-check form-switch mt-4">
                            <input class="form-check-input" type="checkbox" role="switch" name="privacy-policy" id="privacy-policy" value="agreed" required>
                            <label class="form-check-label" for="privacy-policy">
                                Ik ga akkoord met het <a href="./view/privacy-policy.php" target=”_blank”>privacy
                                    beleid</a>.
                            </label>
                            <div class="invalid-feedback">
                                U dient akkoord te gaan met ons privacy beleid.
                            </div>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" name="terms-and-conditions" id="terms-and-conditions" value="agreed" required>
                            <label class="form-check-label" for="terms-and-conditions">
                                Ik ga akkoord met de <a href="./view/terms-and-conditions.php" target="_blank">algemene
                                    voorwaarden</a>.
                            </label>
                            <div class="invalid-feedback">
                                U dient akkoord te gaan met onze algemene voorwaarden.
                            </div>
                        </div>
                        <div class="alert alert-success register-success d-none" role="alert">
                            Bedankt voor uw registratie.
                        </div>
                        <div class="form-button-row d-flex flex-row mt-3">
                            <button class="btn btn-credits shadow-sm my-2" type="submit">Verzenden</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2">
                <h2>Meld je aan en word Betatester!</h2>
                <p>Bij Playm8 zijn wij op zoek naar mensen met voldoende analytisch denkvermogen en affiniteit met
                    IT die
                    Beta-tester willen worden. Met ons Beta-test programma willen wij de functionaliteit en de
                    bruikbaarheid van onze mobiele applicatie testen. Issues en bugs worden direct met onze
                    software-ontwikkelaars teruggekoppeld wat bijdraagt aan de kwaliteit van ons product.</p>
            </div>
        </div>
    </div>
</section>

<?php
include_once 'footer.php';
?>