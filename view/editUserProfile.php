<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

include_once '../header.php';
require_once 'framework/View.php';
require_once 'dao/userProfileDAO.php';

// Check if user is logged in if false redirect to index page else continue
if ($_SESSION["auth"] == false) {
    header("location: ../index.php");
    exit();
};


class createUserProfile extends View
{

    public function show()
    {
        if ($_SESSION["auth_user"]["userProfileID"]) {
            $userProfileID = $_SESSION["auth_user"]["userProfileID"];
            $userProfileDAO = new userProfileDAO;
            if ($userProfileDAO->checkRecordExists($userProfileID)) {
                $userProfile = $userProfileDAO->get($userProfileID);
            }
        };
?>
        <div class="container py-5 h-100">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card shadow">
                        <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                            <h2 style="color:#f8f9fa">Wijzig Gebruikersprofiel</h4>
                                <p>Wijzig hier de gegevens die aan andere Playm8 gebruikers worden getoond.</p>
                        </div>
                        <div class="card-body bg-light p-4 text-black">
                            <form action="../includes/userProfile.inc.php" method="post" class="needs-validation" novalidate>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_name">Voornaam:</label>
                                            <input id="form_name" type="text" name="firstName" class="form-control border-0" placeholder="Voer uw voornaam in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                            echo $userProfile->getFirstName();
                                                                                                                                                                        } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_lastname">Achternaam:</label>
                                            <input id="form_lastname" type="text" name="lastName" class="form-control border-0" placeholder="Voer uw achternaam in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                                echo $userProfile->getLastName();
                                                                                                                                                                            } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_city">Stad:</label>
                                            <input id="form_city" type="text" name="city" class="form-control border-0" placeholder="Voer uw stad in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                    echo $userProfile->getCity();
                                                                                                                                                                } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_country">Land:</label>
                                            <input id="form_country" type="text" name="country" class="form-control border-0" placeholder="Voer uw land in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                        echo $userProfile->getCountry();
                                                                                                                                                                    } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_phoneNumber">Telefoonnummer:</label><br>
                                            <input id="form_phoneNumber" type="tel" name="phoneNumber" class="form-control border-0" placeholder="Voer uw telefoonnummer in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                                        echo $userProfile->getPhoneNumber();
                                                                                                                                                                                    } ?>">
                                            <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
                                            <script>
                                                var input = document.querySelector("#form_phoneNumber");
                                                window.intlTelInput(input, {
                                                    autoInsertDialCode: true,
                                                    nationalMode: false,
                                                    initialCountry: "auto",
                                                    geoIpLookup: function(callback) {
                                                        fetch("https://ipapi.co/json")
                                                            .then(function(res) {
                                                                return res.json();
                                                            })
                                                            .then(function(data) {
                                                                callback(data.country_code);
                                                            })
                                                            .catch(function() {
                                                                callback("nl");
                                                            });
                                                    }
                                                }, {
                                                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="form_dateOfBirth">Geboortedatum:</label>
                                            <input id="form_dateOfBirth" type="date" name="dateOfBirth" class="form-control border-0" placeholder="Voer uw geboortedatum in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                                        echo $userProfile->getDateOfBirth();
                                                                                                                                                                                    } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="form_aboutMeTitle">Over mij koptext:</label>
                                            <input id="form_aboutMeTitle" type="aboutMeTitle" name="aboutMeTitle" class="form-control border-0" placeholder="Voer de titel van uw profielpagina in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                                                                echo $userProfile->getAboutMeTitle();
                                                                                                                                                                                                            } ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="form_aboutMeText">Over:</label>
                                            <textarea id="form_aboutMeText" name="aboutMeText" class="form-control border-0" placeholder="Vertel hier over de favoriete activiteiten, uitlaatplaatsen of andere leuke feitjes over jou en je huisdier! (20 -500 karakters)" rows="4" required><?php if (isset($userProfile)) {
                                                                                                                                                                                                                                                                                                    echo $userProfile->getAboutMeText();
                                                                                                                                                                                                                                                                                                } ?></textarea>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht. (20 - 500 karakters)
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-button-row d-flex flex-row mt-3">
                                    <button class="btn btn-credits shadow-sm my-2" name="submit" type="submit">Opslaan</button>
                                </div>
                                <?php
                                if (isset($_GET["error"])) {
                                    if ($_GET["error"] == "emptyinput") {
                                        echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Alle velden zijn verplicht.</p>';
                                    }
                                    if ($_GET["error"] == "notoflegalage") {
                                        echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Je moet minimaal 18 jaar zijn om een profiel aan te maken.</p>';
                                    }
                                    if ($_GET["error"] == "titlelength") {
                                        echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Over mij koptekst moet uit minimaal 1 en maximaal 255 karakters bestaan.</p>';
                                    }
                                    if ($_GET["error"] == "textlength") {
                                        echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Over mij text moet uit minimaal 20 en maximaal 5000 karakters bestaan.</p>';
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
new createUserProfile;
include_once '../footer.php';
