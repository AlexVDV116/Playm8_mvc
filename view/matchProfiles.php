<?php

// Define the namespace of this class
namespace View;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once $ROOT . 'vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\userProfileDAO;
use Controller\translatorController;

// Used to translate the header on this page
$translator = new translatorController;
// Use the getLanguageFile method of the languageSelector and require the correct language file
require $ROOT . $translator->getLanguageFile();

// userProfilePage class that displays the userProfile details of the user
class matchProfiles extends View
{

    public function show()
    {
        $ROOT = '../';

        // Used to translate page content
        $translator = new translatorController;
        // Use the getLanguageFile method of the languageSelector and require the correct language file
        require $ROOT . $translator->getLanguageFile();

        $header = new header();

        $myUserProfileID = $_SESSION['auth_user']['userProfileID'];
        $userProfileDAO = new userProfileDAO();

        if (isset($_POST['dislike'])) {
            // Get a new random userProfileID from the userProfileDAO
            $userProfile = $userProfileDAO->getRandomuserProfileID($myUserProfileID);
        } elseif (isset($_POST['like'])) {
            // Add userProfileID of the liked user to the current user likes table
            $userProfileDAO->addLike($myUserProfileID, $_POST['likedUserProfileID']);

            // Check if the liked userProfileID also liked the current user
            $match = $userProfileDAO->checkMatch($myUserProfileID, $_POST['likedUserProfileID']);

            // Display match
            if ($match) {
                $match = $userProfileDAO->get($_POST['likedUserProfileID']);
                echo "<div class='text-center'>";
                echo "<h1>Match!</h1>";
                echo "<p> Je hebt een match met " . $match->get("firstName") . " " . $match->get("lastName") . "</p>";
                echo "</div>";
            }

            // Get a new random userProfileID from the userProfileDAO
            $userProfile = $userProfileDAO->getRandomuserProfileID($myUserProfileID);
        } else {
            // Get a new random userProfileID from the userProfileDAO
            $userProfile = $userProfileDAO->getRandomuserProfileID($myUserProfileID);
        }

        // Render userProfile HTML if there are userProfiles left to show, else render error message
        if ($userProfile !== false) {
?>
            <div class="container py-5">
                <div class="row">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class='col d-flex justify-content-centr'>
                            <form method="post">
                                <input type="hidden" name='dislikedUserProfileID' value=<?= $userProfile->get("userProfileID") ?>>
                                <button class="match-button" type="submit" name="dislike">
                                    <i class="fa-solid fa-heart-crack match-icon"></i>
                                    <p><?= $translator->__('Negeer') ?></p>
                                </button>
                            </form>
                        </div>
                        <div class="col col-lg-9 col-xl-7">
                            <div class="card shadow">
                                <div class="rounded-top text-white d-flex flex-row banner-top">
                                    <div class="ms-4 mt-5 d-flex flex-column">
                                        <?php
                                        if ($userProfile->get("userProfilePicture") == "default") { ?>
                                            <img src="../uploads/profilePictures/default.png" alt="Profile picture" class="profilePicture img-fluid img-thumbnail mt-4 mb-2">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="../uploads/profilePictures/<?php echo $userProfile->get("userProfilePicture") ?>" alt="Profile picture" class="profilePicture img-fluid img-thumbnail mt-4 mb-2">
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="ms-3" style="margin-top: 80px;">
                                        <h5 style="color: #fff"><?= $userProfile->get("firstName") ?></h5>
                                        <p><?= $userProfile->get("city") . ", " . $userProfile->get("country") ?></p>
                                        <p><?= $userProfile->get("age") ?></p>
                                    </div>
                                </div>
                                <div class="card-body p-4 text-black">
                                    <div class="row d-flex justify-content-center">
                                        <div class="about-me-section">
                                            <p class="lead fw-normal mb-1"><?= $userProfile->get("aboutMeTitle") ?></p>
                                            <div class="p-4" style="background-color: #f8f9fa;">
                                                <p class="font-italic mb-1"><?= $userProfile->get("aboutMeText") ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <p class="lead fw-normal mb-0"><?= $translator->__('Recente afbeeldingen') ?></p>
                                            <p class="mb-0"><a href="#!" class="text-muted"><?= $translator->__('Alle afbeeldingen weergeven') ?></a></p>
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col mb-2">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(112).webp" alt="image 1" class="w-100 rounded-3">
                                        </div>
                                        <div class="col mb-2">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(107).webp" alt="image 1" class="w-100 rounded-3">
                                        </div>
                                    </div>
                                    <div class="row g-2">
                                        <div class="col">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(108).webp" alt="image 1" class="w-100 rounded-3">
                                        </div>
                                        <div class="col">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Lightbox/Original/img%20(114).webp" alt="image 1" class="w-100 rounded-3">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col d-flex justify-content-center'>
                            <form method="post">
                                <input type="hidden" name='likedUserProfileID' value=<?= $userProfile->get("userProfileID") ?>>
                                <button class="match-button" type="submit" name="like">
                                    <i class="fa-solid fa-heart match-icon"></i>
                                    <p><?= $translator->__('Match') ?></p>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
<?php
        } else {
            echo "<div class='text-center'>";
            echo "<h4>" . $translator->__('Geen gebruikersprofielen meer') . "</h1>";
            echo "<p>" . $translator->__('Wacht een tijdje tot er nieuwe gebruikers registreren om meer matches te vinden.') . "</p>";
            echo "</div>";
        }
    }
}
new matchProfiles();
// Include the footer
$footer = new footer();
