<?php
session_start();

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);\
*/

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

class editUserProfile extends View
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
        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-9 col-xl-7">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa">Wijzig Gebruikersprofiel</h4>
                                    <p>Wijzig hier de gegevens van het gebruikersprofiel dat aan andere Playm8 gebruikers wordt getoond.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">
                                <div class="row mb-4">
                                    <div class="d-flex justify-content-center mb-2">
                                        <form action="../includes/uploads.inc.php" method="post" enctype="multipart/form-data">
                                            <?php
                                            // If user has a default profile picture display default profile picture with his initials
                                            // Else display his own profile picture
                                            if ($userProfile->getUserProfilePicture() == "default") { ?>
                                                <img src="../uploads/profilePictures/default.png" alt="Profile picture" class="editProfilePicture img-fluid img-thumbnail mt-4 mb-2">
                                            <?php
                                            } else {
                                            ?>
                                                <img src="../uploads/profilePictures/<?php echo $userProfile->getUserProfilePicture() ?>" alt="Profile picture" class="editProfilePicture img-fluid img-thumbnail mt-4 mb-2">
                                            <?php
                                            }
                                            ?>
                                            <!-- Modal -->
                                            <div class="modal fade" id="changeProfilePictureModal" tabindex="-1" aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5">Wijzig profielfoto</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="file" class="form-control form-control-sm" id="formFile" name="file">
                                                            <input type="submit" class="form-control form-control-sm" name="submit" value="Wijzig profielfoto">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-credits shadow-sm" data-bs-toggle="modal" data-bs-target="#changeProfilePictureModal">
                                            Wijzig profielfoto
                                        </button>
                                    </div>
                                </div>

                                <form action="../includes/userProfile.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
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

                                    <div class="row mt-4">
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

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_phoneNumber">Telefoonnummer:</label><br>
                                                <input id="form_phoneNumber" type="tel" name="phoneNumber" class="form-control border-0" placeholder="Voer uw telefoonnummer in" value="<?php if (isset($userProfile)) {
                                                                                                                                                                                            echo $userProfile->getPhoneNumber();
                                                                                                                                                                                        } ?>">
                                            </div>
                                            <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
                                            <script>
                                                let input = document.querySelector("#form_phoneNumber");
                                                window.intlTelInput(
                                                    input, {
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
                                                        },
                                                    }, {
                                                        utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
                                                    }
                                                );
                                            </script>
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

                                    <div class="row mt-4">
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

                                    <div class="row mt-4 mb-5">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="form_aboutMeText">Over:</label>
                                                <textarea id="form_aboutMeText" name="aboutMeText" class="form-control border-0" placeholder="Vertel hier over de favoriete activiteiten, uitlaatplaatsen of andere leuke feitjes over jou en je huisdier! (20 -255 karakters)" rows="4" maxlength="10000" required><?php if (isset($userProfile)) {
                                                                                                                                                                                                                                                                                                                        echo $userProfile->getAboutMeText();
                                                                                                                                                                                                                                                                                                                    } ?></textarea>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht. (20 - 500 karakters)
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-button-row mt-3">
                                        <a href="../view/UserProfilePage.php" class="btn btn-cancel shadow-sm mx-3">Annuleer</a>
                                        <button class="btn btn-credits shadow-sm" name="submit" type="submit">Opslaan</button>
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
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Over mij koptekst moet uit minimaal 1 en maximaal 250 karakters bestaan.</p>';
                                        }
                                        if ($_GET["error"] == "textlength") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Over mij text moet uit minimaal 20 en maximaal 2500 karakters bestaan.</p>';
                                        }
                                    }
                                    if (isset($_GET["confirm"])) {
                                        if ($_GET["confirm"] == "fail") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuiste bevestiging, gebruikersprofiel niet verwijderd.</p>';
                                        }
                                    }
                                    ?>
                                </form>
                                <div class="row mt-2">
                                    <div class="d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#deleteUserProfileModal">
                                            Verwijder gebruikersprofiel
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteUserProfileModal" tabindex="-1" aria-labelledby="deleteUserProfileModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5">Bevestig verwijderen van gebruikersprofiel</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $randomNumber = rand(10000, 99999);
                                                echo "<div class='d-flex justify-content-center'>";
                                                echo "<h5>" . $randomNumber . "</h5></div>";
                                                $_SESSION["randomNumbers"] = $randomNumber;
                                                ?>
                                                <form action="../includes/deleteUserProfile.inc.php" method="post" class="needs-validation" novalidate>
                                                    <input id="form_userConfirmNumbers" type="text" name="userConfirmNumbers" class="form-control border-1" placeholder="Voer de 5 cijfers in ter bevestiging om uw account te verwijderen" maxlength="5" required>
                                                    <div class="row">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn btn-cancel shadow-sm mt-3" data-bs-dismiss="modal">Annuleer</button>
                                                            <button type="submit" name="submit" class="btn btn-credits shadow-sm mt-3">Bevestig</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            // Setting the ROOT directory for this file so the relative paths used in included pages will still work
            $ROOT = '../';
            include_once '../footer.php';
            ?>
        </div>
        </div>
<?php
    }
}
new editUserProfile;
