<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use DAO\userProfileDAO;

// Controller class that handles user input when registering as a beta user
// Connects to the database trough an instance of the accountDAO class

class fileController extends Controller
{
    private string $userProfileID;
    private string $fileName;
    private string $fileTmpName;
    private int $fileSize;
    private string $fileType;
    private string $fileError;


    public function __construct($userProfileID, $file)
    {
        $this->userProfileID = $userProfileID;
        $this->fileName = $file["name"];
        $this->fileTmpName = $file["tmp_name"];
        $this->fileSize = $file["size"];
        $this->fileType = $file["type"];
        $this->fileError = $file["error"];
    }

    public function run(): void
    {
        // Grab the extension of the file
        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowedExt = ["jpg", "jpeg", "png"];
        $time = time();

        // Check if file extension is allowed else redirect with error message
        if (in_array($fileActualExt, $allowedExt)) {
            // Check if an error occuroed while uploading
            if ($this->fileError === 0) {
                // Check if the file size is less then 5 megabytes
                if ($this->fileSize < 5120000) {
                    // Generate an unique file name and concat with file extentsion
                    // Add time in second since 1970 to generate a unique file name in order to force browser to recache/download image
                    $fileNameNew = "profilePic_" . $this->userProfileID . "_" . $time . "." . $fileActualExt;
                    $fileDest = '../uploads/profilePictures/' . $fileNameNew;

                    // Update the userProfiles.userProfilePicture collum with the new filename
                    $userProfileDAO = new userProfileDAO;
                    $userProfile = $userProfileDAO->get($this->userProfileID);

                    // Check if user has a user has a record in userProfiles
                    if ($userProfileDAO->checkRecordExists($this->userProfileID) == true) {
                        // If he has a profilePicture set other then default
                        if ($userProfile->userProfilePicture !== "default") {
                            // Grab the location, name and extension of the old userProfilePicture
                            $oldProfilePicture = "../uploads/profilePictures/" . $userProfile->userProfilePicture;
                            // Delete the old profilePicture
                            array_map('unlink', glob($oldProfilePicture));
                        }

                        // Move the file from the tmp location to the uploads folder
                        // If you run this using XAMPP make sure the Apache process owner has read/write permission to your file destination folder
                        move_uploaded_file($this->fileTmpName, $fileDest);

                        // Update the userProfilePicture with the new filename and extension
                        $userProfileDAO->updateUserProfilePicture($fileNameNew, $this->userProfileID);

                        // Redirect user with success message
                        header("location: ../view/editUserProfile.php?upload=success");
                    } else {
                        header("location: ../view/editUserProfile.php?upload=fail");
                    }
                } else {
                    header("location: ../view/editUserProfile.php?error=filesize");
                    exit();
                }
            } else {
                header("location: ../view/editUserProfile.php?error=uploaderror");
                exit();
            }
        } else {
            header("location: ../view/editUserProfile.php?error=fileextnotallowed");
            exit();
        }
    }
}
